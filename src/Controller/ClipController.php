<?php

namespace App\Controller;

use App\Repository\ClipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/clip')]
class ClipController extends AbstractController {
    #[Route('/', name: 'app_clip_index', methods: ['GET'])]
    public function index(ClipRepository $clipRepository): Response {
        return $this->render('clip/index.html.twig', [
            'clips' => $clipRepository->findAll(),
        ]);
    }
}