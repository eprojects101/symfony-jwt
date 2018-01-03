<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Grouper;
use DomainBundle\Document\Material;
use DomainBundle\Document\Pitch;
use DomainBundle\Document\Product;
use DomainBundle\Document\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    const CONTENT_CREATOR="Gestor de conteúdo",SALESPERSON="Vendedor";

    /**
     * @Route("/users")
     * @Method({"GET"})
     */
    public function getUsers()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $users = [];
        foreach($dm->getRepository('DomainBundle:User')->findAll() as $user){
            $users[]=$user->jsonSerialize();
        }

        $response = new JsonResponse(json_encode($users));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/users/{id}")
     * @Method({"GET"})
     */
    public function getUserToEdit($id)
    {

        $dm = $this->get('doctrine_mongodb')->getManager();
        $user = $dm->getRepository('DomainBundle:User')->find($id);

        $response = new JsonResponse(json_encode($user));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/users")
     * @Method({"POST"})
     */
    public function saveUser(Request $request)
    {
        $dm = $this->get('doctrine_mongodb')->getManager();

        $params = array();
        $content = $request->getContent();
        if (!empty($content))
        {
            $params = json_decode($content, true);

            $user = new User();

            if(!array_key_exists("id",$params)){
                $user->setName($params["name"]);
                $user->setEmail($params["email"]);
                $user->setAbout($params["about"]);
                $user->setPhoto($params["photo"]);

                if(array_key_exists("salesperson",$params)) $roles[] = UserController::SALESPERSON;
                if(array_key_exists("contentCreator",$params)) $roles[] = UserController::CONTENT_CREATOR;

                $user->setRoles($roles);
            }

            $dm->persist($user);
            $dm->flush();
        }

        $response = new JsonResponse(json_encode($user->getId()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;

    }

    /**
     * @Route("/login")
     * @Method({"POST"})
     */
    public function login(Request $request)
    {
        $params = array();
        $content = $request->getContent();

        if (!empty($content))
        {
            $params = json_decode($content, true);

            $dm = $this->get('doctrine_mongodb')->getManager();
            $user = $dm->getRepository('DomainBundle:User')->findOneBy(array('email' => $params["email"]));
        }

        $response = new JsonResponse(json_encode($user->jsonSerialize()));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
