<?php

namespace App\Controller;

use App\Entity\AirponClient;
use App\Form\AirponClientType;
use App\Repository\AirponClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/airpon/client')]
class AirponClientController extends AbstractController
{
    #[Route('/', name: 'app_airpon_client_index', methods: ['GET'])]
    public function index(AirponClientRepository $airponClientRepository): Response
    {
        return $this->render('airpon_client/index.html.twig', [
            'airpon_clients' => $airponClientRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_airpon_client_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $airponClient = new AirponClient();
        $form = $this->createForm(AirponClientType::class, $airponClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($airponClient);
            $entityManager->flush();

            $this->addFlash("success", "AirponClient ajouté avec succés");


            return $this->redirectToRoute('app_airpon_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('airpon_client/new.html.twig', [
            'airpon_client' => $airponClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_airpon_client_show', methods: ['GET'])]
    public function show(AirponClient $airponClient): Response
    {
        return $this->render('airpon_client/show.html.twig', [
            'airpon_client' => $airponClient,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_airpon_client_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AirponClient $airponClient, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AirponClientType::class, $airponClient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "AirponClient modifié avec succés");


            return $this->redirectToRoute('app_airpon_client_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('airpon_client/edit.html.twig', [
            'airpon_client' => $airponClient,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_airpon_client_delete', methods: ['POST'])]
    public function delete(Request $request, AirponClient $airponClient, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$airponClient->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($airponClient);
            $entityManager->flush();
        }

        $this->addFlash("success", "AirponClient suprimé avec succés");


        return $this->redirectToRoute('app_airpon_client_index', [], Response::HTTP_SEE_OTHER);
    }
}
