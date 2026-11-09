<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TestTwigController extends AbstractController
{
    #[Route('/testtwig', name: 'app_test_twig')]
    public function index(): Response
    {
        $users = [];
        $user = ['nom' => 'Gardner', 'age' => 40];
        $users[] = $user;
        $user = ['nom' => 'Rayner', 'age' => 30];
        $users[] = $user;
        $user = ['nom' => 'Jordan', 'age' => 39];
        $users[] = $user;
        $user = ['nom' => 'Stewart', 'age' => 32];
        $users[] = $user;
        $user = ['nom' => 'Kent', 'age' => 25];
        $users[] = $user;
        $user = ['nom' => 'Wayne' , 'age' => 27];
        $users[] = $user;
        $user = ['nom' => 'Allen', 'age' => 34];
        $users[] = $user;
        return $this->render('club/testtwig.html.twig', [
            'titre' => 'page accueil',
            'users' => $users
        ]);
    }
}
