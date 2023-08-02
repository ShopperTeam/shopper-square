<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminHomepageController extends AbstractController
{
    #[Route('/admin/homepage', name: 'app_admin_homepage')]
    public function index(): Response
    {

        return $this->render('admin_homepage/index.html.twig', [
            'controller_name' => 'AdminHomepageController',
        ]);
    }


    #[Route('/admin/stock', name: 'app_admin_stock')]
    public function stock(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('admin_homepage/stock/stock.html.twig', [
            'controller_name' => 'AdminHomepageController',
            'products' => $productRepository->findAll()
        ]);
    }
}
