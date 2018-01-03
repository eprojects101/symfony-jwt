<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Company;
use DomainBundle\Document\Fact;
use DomainBundle\Document\Grouper;
use DomainBundle\Document\Material;
use DomainBundle\Document\Pitch;
use DomainBundle\Document\Product;
use DomainBundle\Document\User;
use MongoId;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PitchController extends Controller
{
    /**
     * @Route("/pitches")
     * @Method({"GET"})
     */
    public function getPitches()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $pitches = [];
        foreach($dm->getRepository('DomainBundle:Pitch')->findAll() as $pitch){
            $pitches[]=$pitch->toList();
        }

        $response = new JsonResponse(json_encode($pitches));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/pitches/{id}")
     * @Method({"GET"})
     */
    public function getPitch($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $pitch = $dm->getRepository('DomainBundle:Pitch')->find($id);

        $response = new JsonResponse(json_encode($pitch->jsonSerialize()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/pitches")
     * @Method({"POST"})
     */
    public function savePitch(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);

            $pitch = new Pitch();

            if(!array_key_exists("id",$params)){

                $params["name"]!=null ? $pitch->setName($params["name"]) : null; ;
                $params["segment"]!=null ? $pitch->setSegment($params["segment"]) : null; ;
                $params["pains"]!=null ? $pitch->setPains($params["pains"]) : null; ;

                $pitch->setCreatedAt(date("d-m-Y H:i:s"));
                $pitch->setCompanySegment(new Product());

                if($params["segment"]!=null && $params["pains"]!=null){
                    $productsResult = $dm->createQueryBuilder('DomainBundle:Product')
                        ->field('segments')->in(array($pitch->getSegment()))
                        ->field('pains')->in($pitch->getPains())
                        ->field('cloned')->equals(false)
                        ->getQuery()
                        ->execute();

                    $products = [];

                    foreach($productsResult as $product){

                        $localProduct = clone $product;
                        $localProduct->setId(null);
                        $localProduct->setCloned(true);

                        $products[]=$localProduct;
                    }

                    $pitch->setProducts($products);
                }
            }else if(array_key_exists("id",$params) && array_key_exists("products", $params)){
                $pitch = $dm->getRepository('DomainBundle:Pitch')->findOneBy(array('_id' => new MongoId($params["id"])));

                $products = [];

                foreach($params["products"] as $product){

                    $product = $dm->getRepository('DomainBundle:Product')->findOneBy(array('_id' => new MongoId($product["id"])));

                    $localProduct = clone $product;
                    $localProduct->setId(null);
                    $localProduct->setCloned(true);

                    $products[]=$localProduct;
                }

                $pitch->setProducts($products);

                //$owner = $dm->getRepository('DomainBundle:User')->findOneBy(array('_id' => new MongoId($params["owner"])));
                //$pitch->setOwner($owner);

            }

            if(array_key_exists("id",$params) && array_key_exists("company", $params)){
                $pitch = $dm->getRepository('DomainBundle:Pitch')->findOneBy(array('_id' => new MongoId($params["id"])));

                $company = new Company();

                foreach($params["company"]["facts"] as $f){
                    $fact = new Fact();
                    if(array_key_exists("title", $f)) $fact->setKey($f["title"]);
                    if(array_key_exists("description", $f)) $fact->setValue($f["description"]);

                    $facts[]=$fact;
                }
                $company->setFacts($facts);

                $numbers = [];
                foreach($params["company"]["numbers"] as $f){
                    $fact = new Fact();
                    if(array_key_exists("key", $f)) $fact->setKey($f["key"]);
                    if(array_key_exists("value", $f)) $fact->setValue($f["value"]);

                    $numbers[]=$fact;
                }
                $company->setNumbers($numbers);

                $pitch->setCompany($company);
            }

            $dm->persist($pitch);
            $dm->flush();
        }

        $response = new JsonResponse($pitch);
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }
}
