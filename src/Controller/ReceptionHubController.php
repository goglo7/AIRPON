<?php

namespace App\Controller;

use App\Entity\ReceptionHub;
use App\Form\ReceptionHubType;
use App\Repository\ReceptionHubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reception/hub')]
class ReceptionHubController extends AbstractController
{
    #[Route('/', name: 'app_reception_hub_index', methods: ['GET'])]
    public function index(ReceptionHubRepository $receptionHubRepository): Response
    {
        return $this->render('reception_hub/index.html.twig', [
            'reception_hubs' => $receptionHubRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reception_hub_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $receptionHub = new ReceptionHub();
        $form = $this->createForm(ReceptionHubType::class, $receptionHub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($receptionHub);
            $entityManager->flush();
            $this->addFlash("success", "Reception hub ajouté avec succés");

            return $this->redirectToRoute('app_reception_hub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reception_hub/new.html.twig', [
            'reception_hub' => $receptionHub,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reception_hub_show', methods: ['GET'])]
    public function show(ReceptionHub $receptionHub): Response
    {
        return $this->render('reception_hub/show.html.twig', [
            'reception_hub' => $receptionHub,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reception_hub_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReceptionHub $receptionHub, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReceptionHubType::class, $receptionHub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Reception hub modifié avec succés");

            return $this->redirectToRoute('app_reception_hub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reception_hub/edit.html.twig', [
            'reception_hub' => $receptionHub,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reception_hub_delete', methods: ['POST'])]
    public function delete(Request $request, ReceptionHub $receptionHub, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$receptionHub->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($receptionHub);
            $entityManager->flush();
        }
        $this->addFlash("success", "Reception hub suprimé avec succés");

        return $this->redirectToRoute('app_reception_hub_index', [], Response::HTTP_SEE_OTHER);
    }
}
