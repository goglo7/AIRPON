<?php

namespace App\Controller;

use App\Entity\TypeOlt;
use App\Form\TypeOltType;
use App\Repository\TypeOltRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/type/olt')]
class TypeOltController extends AbstractController
{
    #[Route('/', name: 'app_type_olt_index', methods: ['GET'])]
    public function index(TypeOltRepository $typeOltRepository): Response
    {
        return $this->render('type_olt/index.html.twig', [
            'type_olts' => $typeOltRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_olt_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeOlt = new TypeOlt();
        $form = $this->createForm(TypeOltType::class, $typeOlt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeOlt);
            $entityManager->flush();

            $this->addFlash("success", "Type OLT ajouté avec succés");


            return $this->redirectToRoute('app_type_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_olt/new.html.twig', [
            'type_olt' => $typeOlt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_olt_show', methods: ['GET'])]
    public function show(TypeOlt $typeOlt): Response
    {
        return $this->render('type_olt/show.html.twig', [
            'type_olt' => $typeOlt,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_olt_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeOlt $typeOlt, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeOltType::class, $typeOlt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "Type OLT modifié avec succés");


            return $this->redirectToRoute('app_type_olt_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_olt/edit.html.twig', [
            'type_olt' => $typeOlt,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_olt_delete', methods: ['POST'])]
    public function delete(Request $request, TypeOlt $typeOlt, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeOlt->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($typeOlt);
            $entityManager->flush();
        }

        $this->addFlash("success", "Type OLT suprimé avec succés");


        return $this->redirectToRoute('app_type_olt_index', [], Response::HTTP_SEE_OTHER);
    }
}
