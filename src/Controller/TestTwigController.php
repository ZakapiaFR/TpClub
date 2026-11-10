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

        // Ajout d'une image aléatoire et d'une date de création aléatoire à chaque user
        foreach ($users as &$user) {
            $user['image'] = 'https://i.pravatar.cc/300?img=' . rand(1, 70);
            $user['createdAt'] = rand(2010, 2024) . '-'
                . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-'
                . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT);
        }
        unset($user); // important après un foreach par référence
        
        return $this->render('club/testtwig.html.twig', [
            'titre' => 'page accueil',
            'users' => $users
        ]);
    }
}
