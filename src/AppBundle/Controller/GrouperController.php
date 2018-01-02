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

class GrouperController extends Controller
{
    /**
     * @Route("/groupers")
     * @Method({"GET"})
     */
    public function getGroupers()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $groupers = [];
        foreach($dm->getRepository('DomainBundle:Grouper')->findAll() as $grouper){
            $groupers[]=$grouper->jsonSerialize();
        }

        $response = new JsonResponse(json_encode($groupers));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/groupers")
     * @Method({"POST"})
     */
    public function saveGrouper(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);

            $grouper = new Grouper();
            $grouper->setLabel($params["label"]);
            //$grouper->setIcon($params["icon"]);

            $dm->persist($grouper);
            $dm->flush();
        }

        $response = new JsonResponse(json_encode($grouper->getId()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }

    /**
     * @Route("/groupers/{id}")
     * @Method({"DELETE","OPTIONS"})
     */
    public function deleteGrouper($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $grouper = $dm->getRepository('DomainBundle:Grouper')->findOneBy(array('label' => $id));

        if ($grouper != null) {

            $dm->remove($grouper);
            $dm->flush();

        }

        $response = new JsonResponse(Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

        return $response;

    }
}
