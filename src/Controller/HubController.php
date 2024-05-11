<?php

namespace App\Controller;

use App\Entity\Hub;
use App\Form\HubType;
use App\Repository\HubRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/hub')]
class HubController extends AbstractController
{
    #[Route('/', name: 'app_hub_index', methods: ['GET'])]
    public function index(HubRepository $hubRepository): Response
    {
        return $this->render('hub/index.html.twig', [
            'hubs' => $hubRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hub_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hub = new Hub();
        $form = $this->createForm(HubType::class, $hub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hub);
            $entityManager->flush();

            $this->addFlash("success", "Hub ajouté avec succés");


            return $this->redirectToRoute('app_hub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hub/new.html.twig', [
            'hub' => $hub,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hub_show', methods: ['GET'])]
    public function show(Hub $hub): Response
    {
        return $this->render('hub/show.html.twig', [
            'hub' => $hub,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hub_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hub $hub, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HubType::class, $hub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Hub modifié avec succés");


            return $this->redirectToRoute('app_hub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('hub/edit.html.twig', [
            'hub' => $hub,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hub_delete', methods: ['POST'])]
    public function delete(Request $request, Hub $hub, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hub->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($hub);
            $entityManager->flush();
        }

        $this->addFlash("success", "Hub suprimé avec succés");


        return $this->redirectToRoute('app_hub_index', [], Response::HTTP_SEE_OTHER);
    }
}
