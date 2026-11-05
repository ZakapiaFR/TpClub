<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }
    #[Route('/club/{id}/{nom}', name: 'app_club_testParam' , requirements: ['id' => '[0-9]{2,6}','nom' =>'[a-zA-Z ]{3,25}'])]
    public function testParam(int $id, string $nom): Response{
        return $this->render('club/testParam.html.twig', [
            'id' => $id,
            'nom' => $nom,
        ]);
    }
}
