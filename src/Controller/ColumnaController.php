<?php

namespace App\Controller;

use App\Entity\Columna;
use App\Form\ColumnaType;
use App\Repository\ColumnaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/columna')]
class ColumnaController extends AbstractController {
    #[Route('/', name: 'app_columna_index', methods: ['GET'])]
    public function index(ColumnaRepository $columnaRepository): Response {
        return $this->render('columna/index.html.twig', [
            'columnas' => $columnaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_columna_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $columna = new Columna();
        $form = $this->createForm(ColumnaType::class, $columna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($columna);
            $entityManager->flush();

            return $this->redirectToRoute('app_columna_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('columna/new.html.twig', [
            'columna' => $columna,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_columna_show', methods: ['GET'])]
    public function show(Columna $columna): Response {
        return $this->render('columna/show.html.twig', [
            'columna' => $columna,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_columna_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Columna $columna, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(ColumnaType::class, $columna);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_columna_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('columna/edit.html.twig', [
            'columna' => $columna,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_columna_delete', methods: ['POST'])]
    public function delete(Request $request, Columna $columna, EntityManagerInterface $entityManager): Response {
        if ($this->isCsrfTokenValid('delete'.$columna->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($columna);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_columna_index', [], Response::HTTP_SEE_OTHER);
    }
}
