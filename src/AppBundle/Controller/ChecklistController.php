<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Checklist;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;

class ChecklistController extends Controller
{
    /**
     * @Route("/tips")
     * @Method({"POST"})
     */
    public function saveTip(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();
        $checklist = new Checklist();

        if (!empty($content))
        {
            $params = json_decode($content, true);


            $checklist->setQuestion($params["question"]);
            $checklist->setSegment($params["segment"]);
            $checklist->setPain($params["pain"]);
            $checklist->setCreatedAt(date("d-m-Y H:i:s"));

            $dm->persist($checklist);
            $dm->flush();
        }

        $response = new JsonResponse(json_encode($checklist->getId()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }

    /**
     * @Route("/tips/_segment/{segment}")
     * @Method({"GET"})
     */
    public function getTipsBySegment($segment)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $checklists = [];
        foreach($dm->getRepository('DomainBundle:Checklist')->findBy(array('segment' => $segment)) as $checklist){
            $checklists[]=$checklist->toList();
        }

        $response = new JsonResponse(json_encode($checklists));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/tips")
     * @Method({"GET"})
     */
    public function getTips()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $tips = [];
        foreach($dm->getRepository('DomainBundle:Checklist')->findAll() as $tip){
            $tips[]=$tip->toList();
        }

        $response = new JsonResponse(json_encode($tips));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }


    /**
     * @Route("/tips/{id}")
     * @Method({"DELETE"})
     */
    public function deleteTip($id)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $checklist = $dm->getRepository('DomainBundle:Checklist')->find(str_replace('"', '', $id));

        if ($checklist != null) {

            $dm->remove($checklist);
            $dm->flush();

            $response = new JsonResponse(Response::HTTP_OK);
        }else
        {
            $response = new JsonResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');

        return $response;

    }

}
