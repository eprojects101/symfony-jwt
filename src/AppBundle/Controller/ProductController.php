<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Material;
use DomainBundle\Document\Product;
use MongoId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/products")
     * @Method({"GET"})
     */
    public function getProducts()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $products = [];
        foreach($dm->getRepository('DomainBundle:Product')->findBy(array('cloned' => false)) as $product){
            $products[]=$product->toList();
        }

        $response = new JsonResponse(json_encode($products));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }


    /**
     * @Route("/products/_grouped")
     * @Method({"GET"})
     */
    public function getProductsGrouped()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $groupers = $dm->getRepository('DomainBundle:Grouper')->findAll();

        $groups = [];

        foreach($groupers as $grouper) {
            $products = [];
            foreach($dm->getRepository('DomainBundle:Product')->findBy(array('cloned' => false, 'grouper' => $grouper->getLabel())) as $product){

                /*
                $highlight=$product->getHighlight();
                $benefits=$product->getBenefits();
                $otherCustomers=$product->getOtherCustomers();
                $cases=$product->getCases();
                $medias = $product->getMedias();
                */

                $products[]=[
                    'id'=>$product->getId(),
                    'name'=>$product->getName(),
                    'grouper'=>$product->getGrouper(),
                    'pains' =>$product->getPains(),
                    'segments' =>$product->getSegments()
                    /*,
                    'grouper'=>$product->getGrouper(),
                    'pains' =>$product->getPains(),
                    'segments' =>$product->getSegments(),
                    'highlight' =>($highlight!=null ? $highlight->jsonSerialize() : null),
                    'benefits' =>($benefits!=null ? $benefits->jsonSerialize() : null),
                    'otherCustomers' =>($otherCustomers!=null ? $otherCustomers->jsonSerialize() : null),
                    'cases' =>($cases!=null ? $cases->jsonSerialize() : null),
                    'medias' =>($medias!=null ? $medias->jsonSerialize() : null)
                    */
                ];

            }
            $groups[]=array(
                'grouper' => $grouper->getLabel(),
                'products' => $products
            );
        }

        $response = new JsonResponse(json_encode($groups));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/products")
     * @Method({"POST"})
     */
    public function saveProduct(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);

            if(!array_key_exists("id",$params)) {
                $product = new Product();
                $product->setCreatedAt(date("d-m-Y H:i:s"));


                if(array_key_exists("owner",$params)) {
                    $owner = $dm->getRepository('DomainBundle:User')->findOneBy(array('_id' => new MongoId($params["owner"])));
                    $product->setOwner($owner);
                }

            }else{
                $product = $dm->getRepository('DomainBundle:Product')->findOneBy(array('_id' => new MongoId($params["id"])));
            }

            $product->setCloned(false);
            $product->setName($params["name"]);
            $product->setGrouper($params["grouper"]);
            $product->setPains($params["pains"]);
            $product->setSegments($params["segments"]);

            $dm->persist($product);
            $dm->flush();
        }

        $response = new JsonResponse(json_encode($product->getId()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }

    /**
     * @Route("/products/_material")
     * @Method({"POST"})
     */
    public function addMaterialToProduct(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true);

            if(array_key_exists("productId",$params)) {

                $product = $dm->getRepository('DomainBundle:Product')->findOneBy(array('_id' => new MongoId($params["productId"])));

                $material = new Material();
                $material->setType($params["type"]);
                $material->setGrouper($product->getGrouper());
                $material->setProduct($product->getName());
                $material->setComplete(true);
                $material->setCreatedAt(date("d-m-Y H:i:s"));
                $material->setPains($product->getPains());
                $material->setSegments($product->getSegments());
                $material->setComplete(true);


                switch ($params["type"]) {

                    case "Destaque":
                        $material->setTitle($params["title"]);
                        $material->setContent($params["content"]);
                        $material->setFileHighlightLink($params["fileHighlightLink"]);
                        $product->setHighlight($material);
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
                        $product->setBenefits($material);
                        break;
                    case "Casos de Sucesso":
                        $material->setTitle($params["title"]);
                        $material->setContent($params["content"]);
                        $material->setFileHighlightLink($params["fileHighlightLink"]);
                        $product->setCases($material);
                        break;
                    case "Clientes de referência":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $material->setFileCustomerMediaLink2($params["fileCustomerMediaLink2"]);
                        $material->setFileCustomerMediaLink3($params["fileCustomerMediaLink3"]);
                        $material->setFileCustomerMediaLink4($params["fileCustomerMediaLink4"]);
                        $product->setOtherCustomers($material);
                        break;
                    case "Mídia":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $material->setFileCustomerMediaLink2($params["fileCustomerMediaLink2"]);
                        $material->setFileCustomerMediaLink3($params["fileCustomerMediaLink3"]);
                        $material->setFileCustomerMediaLink4($params["fileCustomerMediaLink4"]);
                        $product->setMedias($material);
                        break;
                    case "Clientes no segmento":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $material->setFileCustomerMediaLink2($params["fileCustomerMediaLink2"]);
                        $material->setFileCustomerMediaLink3($params["fileCustomerMediaLink3"]);
                        $material->setFileCustomerMediaLink4($params["fileCustomerMediaLink4"]);
                        $product->setCustomersSegment($material);
                        break;
                    case "Mais informações":
                        $material->setTitle($params["title"]);
                        $material->setContent($params["content"]);
                        if(array_key_exists("fileHighlightLink",$params)) $material->setFileHighlightLink($params["fileHighlightLink"]);
                        $product->setMoreInformation($material);
                        break;
                    case "Soluções":
                        $material->setFileCustomerMediaLink1($params["fileCustomerMediaLink1"]);
                        $product->setSolutions($material);
                        break;
                }

            }

            $dm->persist($product);
            $dm->flush();
        }

        $response = new JsonResponse(json_encode($product->getId()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }


    /**
     * @Route("/products/{id}")
     * @Method({"DELETE","OPTIONS"})
     */
    public function deleteProduct($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $product = $dm->getRepository('DomainBundle:Product')->find($id);

        $dm->remove($product);
        $dm->flush();

        $response = new JsonResponse(Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

        return $response;

    }

    /**
     * @Route("/products/{id}")
     * @Method({"GET"})
     */
    public function getProduct($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $product = $dm->getRepository('DomainBundle:Product')->find($id);

        $response = new JsonResponse($product->jsonSerialize());
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

        return $response;

    }
}
