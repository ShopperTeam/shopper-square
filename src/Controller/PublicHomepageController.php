<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicHomepageController extends AbstractController
{
    #[Route('/', name: 'app_public_homepage')]
    public function index(ProductRepository $productRepository): Response
    {

        $featuredProducts = $productRepository->findBy([
            'featured' => true
        ], [
            'id' => 'DESC'
        ]);

        return $this->render('public_homepage/index.html.twig', [
            'featured_products' => $featuredProducts,
        ]);
    }
}
