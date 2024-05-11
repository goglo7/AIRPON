<?php

namespace App\Controller;

use App\Entity\CType;
use App\Form\CTypeType;
use App\Repository\CTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/c/type')]
class CTypeController extends AbstractController
{
    #[Route('/', name: 'app_c_type_index', methods: ['GET'])]
    public function index(CTypeRepository $cTypeRepository): Response
    {
        return $this->render('c_type/index.html.twig', [
            'c_types' => $cTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cType = new CType();
        $form = $this->createForm(CTypeType::class, $cType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cType);
            $entityManager->flush();

            $this->addFlash("success", "CType ajouté avec succés");


            return $this->redirectToRoute('app_c_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('c_type/new.html.twig', [
            'c_type' => $cType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_type_show', methods: ['GET'])]
    public function show(CType $cType): Response
    {
        return $this->render('c_type/show.html.twig', [
            'c_type' => $cType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CType $cType, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CTypeType::class, $cType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash("success", "CType modifié avec succés");


            return $this->redirectToRoute('app_c_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('c_type/edit.html.twig', [
            'c_type' => $cType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_type_delete', methods: ['POST'])]
    public function delete(Request $request, CType $cType, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cType->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($cType);
            $entityManager->flush();
        }

        $this->addFlash("success", "CType suprimé avec succés");


        return $this->redirectToRoute('app_c_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
