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

class SegmentController extends Controller
{
    /**
     * @Route("/segments")
     * @Method({"GET"})
     */
    public function getSegments()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $query = $dm
            ->createQueryBuilder(Material::class)
            ->distinct('segments');

        $cursor = $query->getQuery()->execute();

        foreach ($cursor as $segment) {
            $segments[]=$segment;
        }

        $response = new JsonResponse(json_encode($segments));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
