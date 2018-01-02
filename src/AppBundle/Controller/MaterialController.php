<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Grouper;
use DomainBundle\Document\Material;
use DomainBundle\Document\Pitch;
use DomainBundle\Document\Product;
use MongoId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterialController extends Controller
{
    /**
     * @Route("/materials/_type/{type}")
     * @Method({"GET"})
     */
    public function getProductsByType($type)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $materials = [];
        foreach($dm->getRepository('DomainBundle:Material')->findBy(array('type' => $type, 'complete' => true)) as $material){
            $materials[]=$material->jsonSerialize();
        }

        $response = new JsonResponse(json_encode($materials));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/materials/_filtered")
     * @Method({"POST"})
     */
    public function getProductsByFilter(Request $request)
    {
        $materials = [];

        $params = array();
        $content = $request->getContent();

        if (!empty($content)) {

            $params = json_decode($content, true);

                $dm = $this->get('doctrine_mongodb')->getManager();

                $materialsResult = $dm->createQueryBuilder('DomainBundle:Material')
                    ->field('segments')->in(array($params["segment"]))
                    ->field('type')->equals($params["type"])
                    ->field('pains')->in($params["pains"])
                    ->field('complete')->equals(true)
                    ->getQuery()
                    ->execute();

                $materials = [];
                foreach ($materialsResult as $material) {
                    $materials[] = $material->jsonSerialize();
                }
        }

        $response = new JsonResponse(json_encode($materials));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/materials/_grouped")
     * @Method({"GET"})
     */
    public function getGroupedMaterials()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $materials = [];
        $allProducts = $dm->getRepository('DomainBundle:Product')->findAll();
        $allGroupers = $dm->getRepository('DomainBundle:Grouper')->findAll();

        foreach($allGroupers as $grouper){

            $grouper=[
                "grouper"=>$grouper->getLabel(),
                "products"=>$allProducts
            ];

            $materials[]=$grouper;
            //$products = [];
            //foreach($allProducts as $grouper){
              //  $products[] = $product->getName();

               // foreach($dm->getRepository('DomainBundle:Material')->findBy(array('complete' => true, 'grouper' => $grouper->getLabel(), 'product' => $product->getName())) as $material){
                //    $materials[]=$material->jsonSerialize();
               // }
           // }
        }

        $response = new JsonResponse(json_encode($materials));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }


    /**
     * @Route("/materials")
     * @Method({"GET"})
     */
    public function getMaterials()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $materials = [];

        foreach($dm->getRepository('DomainBundle:Material')->findBy(array('complete' => true)) as $material){
            $materials[]=$material->jsonSerialize();
        }

        $response = new JsonResponse(json_encode($materials));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/materials")
     * @Method({"POST"})
     */
    public function saveMaterial(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);

            $material = new Material();

            if(!array_key_exists("id",$params)){
                $material->setType($params["type"]);
                if(array_key_exists("grouper",$params)) $material->setGrouper($params["grouper"]);
                if(array_key_exists("productName",$params)) $material->setProduct($params["productName"]);
                $material->setComplete(false);
                $material->setCreatedAt(date("d-m-Y H:i:s"));
            }else{

                $material = $dm->getRepository('DomainBundle:Material')->findOneBy(array('_id' => new MongoId($params["id"])));

                $material->setComplete(true);

                switch ($params["type"]) {

                    case "Destaque":
                        $material->setTitle($params["title"]);
                        $material->setContent($params["content"]);
                        if(array_key_exists("fileHighlightLink",$params)) $material->setFileHighlightLink($params["fileHighlightLink"]);
                        break;
                    case "Soluções":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        break;
                    case "Benefícios":
                        $material->setTitle($params["title"]);
                        $material->setSubtitle($params["subtitle"]);
                        $material->setContentBenefits1($params["contentBenefits1"]);
                        $material->setContentBenefits2($params["contentBenefits2"]);
                        $material->setContentBenefits3($params["contentBenefits3"]);
                        $material->setFileBenefitsLink1($params["fileBenefitsLink1"]);
                        $material->setFileBenefitsLink2($params["fileBenefitsLink2"]);
                        $material->setFileBenefitsLink3($params["fileBenefitsLink3"]);
                        break;
                    case "Casos de Sucesso":
                        $material->setTitle($params["title"]);
                        $material->setContent($params["content"]);
                        $material->setFileHighlightLink($params["fileHighlightLink"]);
                        break;
                    case "Mais informações":
                        $material->setTitle($params["title"]);
                        $material->setContent($params["content"]);
                        if(array_key_exists("fileHighlightLink",$params)) $material->setFileHighlightLink($params["fileHighlightLink"]);
                        break;
                    case "Clientes de referência":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $material->setFileCustomerMediaLink2($params["fileCustomerMediaLink2"]);
                        $material->setFileCustomerMediaLink3($params["fileCustomerMediaLink3"]);
                        $material->setFileCustomerMediaLink4($params["fileCustomerMediaLink4"]);
                        break;
                    case "Clientes no segmento":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $material->setFileCustomerMediaLink2($params["fileCustomerMediaLink2"]);
                        $material->setFileCustomerMediaLink3($params["fileCustomerMediaLink3"]);
                        $material->setFileCustomerMediaLink4($params["fileCustomerMediaLink4"]);
                        break;
                    case "Mídia":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $material->setFileCustomerMediaLink2($params["fileCustomerMediaLink2"]);
                        $material->setFileCustomerMediaLink3($params["fileCustomerMediaLink3"]);
                        $material->setFileCustomerMediaLink4($params["fileCustomerMediaLink4"]);
                        break;
                }

                //$owner = $dm->getRepository('DomainBundle:User')->findOneBy(array('_id' => new MongoId($params["owner"])));

                //$material->setOwner($owner);
            }

            $dm->persist($material);
            $dm->flush();
        }

        $response = new JsonResponse($material->getId());
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }

    /**
     * @Route("/materials/{id}")
     * @Method({"DELETE","OPTIONS"})
     */
    public function deleteProduct($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $material = $dm->getRepository('DomainBundle:Material')->find(str_replace('"', '', $id));

        if ($material != null) {

            $dm->remove($material);
            $dm->flush();

            $response = new JsonResponse(Response::HTTP_OK);
        }else
        {
            $response = new JsonResponse(json_decode($id));
        }

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

        return $response;

    }
}
