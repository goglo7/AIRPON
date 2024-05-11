<?php

namespace App\Controller;

use App\Entity\UserRole;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route("", name: "app_")]
class AppController extends  AbstractController
{
    #[Route("", name: "home")]
    public function home(): Response
    {
        if ($this->isGranted(UserRole::ADMIN->value)) {
            return $this->redirectToRoute("app_projet_index");
        }

        if ($this->isGranted(UserRole::RESPONSABLE->value)) {
            return $this->redirectToRoute("app_box_index");
        }

        if ($this->isGranted(UserRole::CLIENTELE->value)) {
            return $this->redirectToRoute("app_client_index");
        }

        throw $this->createNotFoundException("Not found");
    }
}