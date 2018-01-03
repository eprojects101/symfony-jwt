<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Grouper;
use DomainBundle\Document\Material;
use DomainBundle\Document\Pitch;
use DomainBundle\Document\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PainController extends Controller
{

    /**
     * @Route("/pains")
     * @Method({"GET"})
     */
    public function getPains()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $query = $dm
            ->createQueryBuilder(Material::class)
            ->distinct('pains');

        $cursor = $query->getQuery()->execute();

        foreach ($cursor as $pain) {
            $pains[]=$pain;
        }

        $response = new JsonResponse(json_encode($pains));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/pains/{segment}")
     * @Method({"GET"})
     */
    public function getPainsBySegment($segment)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $query = $dm
            ->createQueryBuilder(Material::class)
            ->field('segments')->equals($segment)
            ->distinct('pains');

        $cursor = $query->getQuery()->execute();

        $pains=[];

        foreach ($cursor as $pain) {
            $pains[]=$pain;
        }

        $response = new JsonResponse(json_encode($pains));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
