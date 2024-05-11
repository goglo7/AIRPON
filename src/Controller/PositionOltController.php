<?php

namespace App\Controller;

use App\Entity\PositionOlt;
use App\Form\PositionOltType;
use App\Repository\PositionOltRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/position/olt')]
class PositionOltController extends AbstractController
{
    #[Route('/', name: 'app_position_olt_index', methods: ['GET'])]
    public function index(PositionOltRepository $positionOltRepository): Response
    {
        return $this->render('position_olt/index.html.twig', [
            'position_olts' => $positionOltRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_position_olt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $positionOlt = new PositionOlt();
        $form = $this->createForm(PositionOltType::class, $positionOlt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($positionOlt);
            $entityManager->flush();

            $this->addFlash("success", "Position Olt ajouté avec succés");


            return $this->redirectToRoute('app_position_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('position_olt/new.html.twig', [
            'position_olt' => $positionOlt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_position_olt_show', methods: ['GET'])]
    public function show(PositionOlt $positionOlt): Response
    {
        return $this->render('position_olt/show.html.twig', [
            'position_olt' => $positionOlt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_position_olt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PositionOlt $positionOlt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PositionOltType::class, $positionOlt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Position Olt modifié avec succés");

            return $this->redirectToRoute('app_position_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('position_olt/edit.html.twig', [
            'position_olt' => $positionOlt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_position_olt_delete', methods: ['POST'])]
    public function delete(Request $request, PositionOlt $positionOlt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$positionOlt->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($positionOlt);
            $entityManager->flush();
        }
        $this->addFlash("success", "Position Olt suprimé avec succés");

        return $this->redirectToRoute('app_position_olt_index', [], Response::HTTP_SEE_OTHER);
    }
}
