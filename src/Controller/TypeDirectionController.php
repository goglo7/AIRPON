<?php

namespace App\Controller;

use App\Entity\TypeDirection;
use App\Form\TypeDirectionType;
use App\Repository\TypeDirectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/direction')]
class TypeDirectionController extends AbstractController
{
    #[Route('/', name: 'app_type_direction_index', methods: ['GET'])]
    public function index(TypeDirectionRepository $typeDirectionRepository): Response
    {
        return $this->render('type_direction/index.html.twig', [
            'type_directions' => $typeDirectionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_direction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeDirection = new TypeDirection();
        $form = $this->createForm(TypeDirectionType::class, $typeDirection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeDirection);
            $entityManager->flush();

            $this->addFlash("success", "Type direction ajouté avec succés");


            return $this->redirectToRoute('app_type_direction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_direction/new.html.twig', [
            'type_direction' => $typeDirection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_direction_show', methods: ['GET'])]
    public function show(TypeDirection $typeDirection): Response
    {
        return $this->render('type_direction/show.html.twig', [
            'type_direction' => $typeDirection,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_direction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeDirection $typeDirection, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeDirectionType::class, $typeDirection);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Type direction modifié avec succés");


            return $this->redirectToRoute('app_type_direction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_direction/edit.html.twig', [
            'type_direction' => $typeDirection,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_direction_delete', methods: ['POST'])]
    public function delete(Request $request, TypeDirection $typeDirection, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeDirection->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($typeDirection);
            $entityManager->flush();
        }

        $this->addFlash("success", "Type direction suprimé avec succés");


        return $this->redirectToRoute('app_type_direction_index', [], Response::HTTP_SEE_OTHER);
    }
}
