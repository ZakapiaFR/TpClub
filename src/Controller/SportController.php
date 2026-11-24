<?php

namespace App\Controller;

use App\Repository\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sport')]
final class SportController extends AbstractController
{
    #[Route('/', name: 'app_sport_index', methods: ['GET'])]
    public function index(SportRepository $sportRepository): Response
    {
         return $this->render('sport/index.html.twig', [
            'sports' => $sportRepository->findAll(),
        ]);
    }
    #[Route('/{id}', name: 'app_sport_show', requirements: ['id' => '\d+'],methods: ['GET'])]
    public function show(int $id): Response
    {
        return new Response("Affichege d'un sport");
    }
    #[Route('/new', name: 'app_sport_new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        return new Response("Création d'un sport");
    }
    #[Route('/{id}/edit', name: 'app_sport_edit',requirements: ['id' => '\d+'] ,methods: ['GET' ,'POST'])]
    public function edit(int $id): Response
    {
        return new Response("Création d'un sport");
    }
    #[Route('/{id}/delete', name: 'app_sport_delete',requirements: ['id' => '\d+'] , methods: ['POST'])]
    public function delete(int $id): Response
    {
        return new Response("Suppresion d'un sport");
    }
}
