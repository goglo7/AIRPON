<?php

namespace App\Controller;

use App\Entity\ModemOnt;
use App\Form\ModemOntType;
use App\Repository\ModemOntRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/modem/ont')]
class ModemOntController extends AbstractController
{
    #[Route('/', name: 'app_modem_ont_index', methods: ['GET'])]
    public function index(ModemOntRepository $modemOntRepository): Response
    {
        return $this->render('modem_ont/index.html.twig', [
            'modem_onts' => $modemOntRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_modem_ont_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $modemOnt = new ModemOnt();
        $form = $this->createForm(ModemOntType::class, $modemOnt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($modemOnt);
            $entityManager->flush();

            $this->addFlash("success", "Modem ont ajouté avec succés");

            return $this->redirectToRoute('app_modem_ont_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modem_ont/new.html.twig', [
            'modem_ont' => $modemOnt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modem_ont_show', methods: ['GET'])]
    public function show(ModemOnt $modemOnt): Response
    {
        return $this->render('modem_ont/show.html.twig', [
            'modem_ont' => $modemOnt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_modem_ont_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModemOnt $modemOnt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModemOntType::class, $modemOnt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Modem ont modifié avec succés");


            return $this->redirectToRoute('app_modem_ont_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modem_ont/edit.html.twig', [
            'modem_ont' => $modemOnt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modem_ont_delete', methods: ['POST'])]
    public function delete(Request $request, ModemOnt $modemOnt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modemOnt->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($modemOnt);
            $entityManager->flush();
        }

        $this->addFlash("success", "Modem ont suprimé avec succés");


        return $this->redirectToRoute('app_modem_ont_index', [], Response::HTTP_SEE_OTHER);
    }
}
