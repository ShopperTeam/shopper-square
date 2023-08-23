<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class UserHomepageController extends AbstractController
{
    #[Route('/user/homepage', name: 'app_user_homepage')]
    public function index(Request  $request): Response
    {
        $session = $request->getSession();
        $email =  $session->get('_security.last_username');
        return $this->render('user_homepage/index.html.twig', [
            'controller_name' => 'UserHomepageController',
             'email' => $email
        ]);
    }
}
