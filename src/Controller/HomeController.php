<?php

namespace App\Controller;

use App\Repository\MatosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(MatosRepository $matosRepository): Response
    {

    $allMatos = $matosRepository->findAll();
     // dd($allMatos);

        return $this->render('home.html.twig', [
            'materiels' => $allMatos
        ]);
    }
}
