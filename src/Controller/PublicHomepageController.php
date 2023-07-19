<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicHomepageController extends AbstractController
{
    #[Route('/', name: 'app_public_homepage')]
    public function index(): Response
    {
        return $this->render('public_homepage/index.html.twig', [
            'controller_name' => 'PublicHomepageController',
        ]);
    }
}
