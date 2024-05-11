<?php

namespace App\Controller;

use App\Entity\CableHubBox;
use App\Form\CableHubBoxType;
use App\Repository\CableHubBoxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cable/hub/box')]
class CableHubBoxController extends AbstractController
{
    #[Route('/', name: 'app_cable_hub_box_index', methods: ['GET'])]
    public function index(CableHubBoxRepository $cableHubBoxRepository): Response
    {
        return $this->render('cable_hub_box/index.html.twig', [
            'cable_hub_boxes' => $cableHubBoxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cable_hub_box_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cableHubBox = new CableHubBox();
        $form = $this->createForm(CableHubBoxType::class, $cableHubBox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cableHubBox);
            $entityManager->flush();

            $this->addFlash("success", "Cable hub box ajouté avec succés");


            return $this->redirectToRoute('app_cable_hub_box_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cable_hub_box/new.html.twig', [
            'cable_hub_box' => $cableHubBox,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cable_hub_box_show', methods: ['GET'])]
    public function show(CableHubBox $cableHubBox): Response
    {
        return $this->render('cable_hub_box/show.html.twig', [
            'cable_hub_box' => $cableHubBox,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cable_hub_box_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CableHubBox $cableHubBox, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CableHubBoxType::class, $cableHubBox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Cable hub box modifié avec succés");

            return $this->redirectToRoute('app_cable_hub_box_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cable_hub_box/edit.html.twig', [
            'cable_hub_box' => $cableHubBox,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cable_hub_box_delete', methods: ['POST'])]
    public function delete(Request $request, CableHubBox $cableHubBox, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cableHubBox->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cableHubBox);
            $entityManager->flush();
        }
        $this->addFlash("success", "Cable hub box supprimé avec succés");

        return $this->redirectToRoute('app_cable_hub_box_index', [], Response::HTTP_SEE_OTHER);
    }
}
