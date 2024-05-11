<?php

namespace App\Controller;

use App\Entity\CableInterBox;
use App\Form\CableInterBoxType;
use App\Repository\CableInterBoxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/cable/inter/box')]
class CableInterBoxController extends AbstractController
{
    #[Route('/', name: 'app_cable_inter_box_index', methods: ['GET'])]
    public function index(CableInterBoxRepository $cableInterBoxRepository): Response
    {
        return $this->render('cable_inter_box/index.html.twig', [
            'cable_inter_boxes' => $cableInterBoxRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cable_inter_box_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cableInterBox = new CableInterBox();
        $form = $this->createForm(CableInterBoxType::class, $cableInterBox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cableInterBox);
            $entityManager->flush();

            $this->addFlash("success", "Cable inter box ajouté avec succés");

            return $this->redirectToRoute('app_cable_inter_box_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cable_inter_box/new.html.twig', [
            'cable_inter_box' => $cableInterBox,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cable_inter_box_show', methods: ['GET'])]
    public function show(CableInterBox $cableInterBox): Response
    {
        return $this->render('cable_inter_box/show.html.twig', [
            'cable_inter_box' => $cableInterBox,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cable_inter_box_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CableInterBox $cableInterBox, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CableInterBoxType::class, $cableInterBox);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Cable inter box modifié avec succés");

            return $this->redirectToRoute('app_cable_inter_box_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cable_inter_box/edit.html.twig', [
            'cable_inter_box' => $cableInterBox,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cable_inter_box_delete', methods: ['POST'])]
    public function delete(Request $request, CableInterBox $cableInterBox, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cableInterBox->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cableInterBox);
            $entityManager->flush();
        }
        $this->addFlash("success", "Cable inter box suprimé avec succés");

        return $this->redirectToRoute('app_cable_inter_box_index', [], Response::HTTP_SEE_OTHER);
    }
}
