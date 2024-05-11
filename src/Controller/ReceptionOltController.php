<?php

namespace App\Controller;

use App\Entity\ReceptionOlt;
use App\Form\ReceptionOltType;
use App\Repository\ReceptionOltRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/reception/olt')]
class ReceptionOltController extends AbstractController
{
    #[Route('/', name: 'app_reception_olt_index', methods: ['GET'])]
    public function index(ReceptionOltRepository $receptionOltRepository): Response
    {
        return $this->render('reception_olt/index.html.twig', [
            'reception_olts' => $receptionOltRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reception_olt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $receptionOlt = new ReceptionOlt();
        $form = $this->createForm(ReceptionOltType::class, $receptionOlt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($receptionOlt);
            $entityManager->flush();

            $this->addFlash("success", "Reception olt ajouté avec succés");

            return $this->redirectToRoute('app_reception_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reception_olt/new.html.twig', [
            'reception_olt' => $receptionOlt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reception_olt_show', methods: ['GET'])]
    public function show(ReceptionOlt $receptionOlt): Response
    {
        return $this->render('reception_olt/show.html.twig', [
            'reception_olt' => $receptionOlt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reception_olt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReceptionOlt $receptionOlt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReceptionOltType::class, $receptionOlt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Reception olt modifié avec succés");

            return $this->redirectToRoute('app_reception_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reception_olt/edit.html.twig', [
            'reception_olt' => $receptionOlt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reception_olt_delete', methods: ['POST'])]
    public function delete(Request $request, ReceptionOlt $receptionOlt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$receptionOlt->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($receptionOlt);
            $entityManager->flush();
        }
        $this->addFlash("success", "Reception olt suprimé avec succés");

        return $this->redirectToRoute('app_reception_olt_index', [], Response::HTTP_SEE_OTHER);
    }
}
