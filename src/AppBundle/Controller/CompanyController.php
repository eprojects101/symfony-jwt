<?php

namespace AppBundle\Controller;

use DomainBundle\Document\Grouper;
use DomainBundle\Document\Material;
use DomainBundle\Document\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{

    /**
     * @Route("/companies/{id}")
     * @Method({"GET"})
     */
    public function getCompany($id)
    {
        $r = [
            "about"=>[
                [
                    "icon"=>"icon-match-stick",
                    "title"=>"Missão",
                    "description"=>"A SENIOR é referência nacional em tecnologia para gestão. Com um dos mais completos portfólios para alta performance, oferece soluções em Gestão Empresarial, Logística, Supermercados, Gestão de Pessoas, de Relacionamento com Clientes e Gestão de Acesso e Segurança. São mais de 100 mil contratos ativos em empresas de diversos portes e segmentos."
                ],
                [
                    "icon"=>"icon-paperplane2",
                    "title"=>"Visão",
                    "description"=>"A companhia oferece tanto consultorias como sistemas integrados que apoiam seus clientes na otimização de processos e modelos de negócios, inovação e produtividade, simplificando a tomada de decisão e impulsionando a gestão."
                ],
                [
                    "icon"=>"icon-music-note-1",
                    "title"=>"Valores",
                    "description"=>"São aproximadamente 1300 colaboradores distribuídos entre a sede (Blumenau/SC), filiais, escritórios e unidades de negócios, além de mais de 150 consultores e cerca de 100 canais de distribuição em todo Brasil."
                ],
                [
                    "icon"=>"icon-places-warehouse-1",
                    "title"=>"Negócio",
                    "description"=>"Esta é a SENIOR, uma empresa em constante evolução e que não para de crescer."
                ]
            ],
            "numbers"=>[
                [
                    "key"=>"Colaboradores",
                    "value"=>"+1300"
                ],
                [
                    "key"=>"Receita",
                    "value"=>"257,6"
                ],
                [
                    "key"=>"EBITDA",
                    "value"=>"51,9"
                ],
                [
                    "key"=>"Capacitação",
                    "value"=>"1"
                ],
                [
                    "key"=>"Pesquisa, Desenvolvimento e Inovação",
                    "value"=>"38"
                ]
            ]];

        $response = new JsonResponse(json_encode($r));
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
