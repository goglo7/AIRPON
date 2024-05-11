<?php

namespace App\Controller;

use App\Entity\Olt;
use App\Form\OltType;
use App\Repository\OltRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/olt')]
class OltController extends AbstractController
{
    #[Route('/', name: 'app_olt_index', methods: ['GET'])]
    public function index(OltRepository $oltRepository): Response
    {
        return $this->render('olt/index.html.twig', [
            'olts' => $oltRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_olt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $olt = new Olt();
        $form = $this->createForm(OltType::class, $olt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($olt);
            $entityManager->flush();

            $this->addFlash("success", "OLT ajouté avec succés");


            return $this->redirectToRoute('app_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('olt/new.html.twig', [
            'olt' => $olt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_olt_show', methods: ['GET'])]
    public function show(Olt $olt): Response
    {
        return $this->render('olt/show.html.twig', [
            'olt' => $olt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_olt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Olt $olt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OltType::class, $olt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "OLT modifié avec succés");

            return $this->redirectToRoute('app_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('olt/edit.html.twig', [
            'olt' => $olt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_olt_delete', methods: ['POST'])]
    public function delete(Request $request, Olt $olt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$olt->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($olt);
            $entityManager->flush();
        }

        $this->addFlash("success", "OLT suprimé avec succés");

        return $this->redirectToRoute('app_olt_index', [], Response::HTTP_SEE_OTHER);
    }
}
