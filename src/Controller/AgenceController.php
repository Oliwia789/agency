<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenceController extends AbstractController
{
    #[Route('/biens', name: 'app_agence')]
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }

    #[Route("/", name: "home")]
    public function home()
    {
        return $this->render("agence/home.html.twig");
    }


    #[Route("/biens/nomBien", name: "bien_show")]
    public function show()
    {
        return $this->render("agence/show.html.twig");
    }
}
