<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DefaultController extends AbstractController
{
    #[Route('/hello', name: 'app_hello')]
    public function hello(): Response
    {
       return new Response('Hello Pauloin');
    }

    #[Route('/bissextile/{nb}', name: 'app_bissextile', requirements: ['nb' =>'\d{1,2}'])]
    public function checkBissextile(int $nb): Response
    {
        $anneeCourante = (int) date('Y');
        $annee = $nb + $anneeCourante;
        $estBissextile = ($annee % 4 === 0 && $annee % 100 !== 0) || $annee % 400 === 0;
        return $this->render('default/bissextile.html.twig', [
            'nb' => $nb,
            'anneeCourante' => $anneeCourante,
            'annee' => $annee,
            'estBissextile' => $estBissextile,
        ]);
    }
}
