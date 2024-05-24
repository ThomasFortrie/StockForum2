<?php

namespace App\Controller;

use App\Entity\Matos;
use App\Repository\MatosRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/plus/{id}', name: 'plusOne', requirements: ['id' => '\d+'])]
    public function updatePlusOne(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Matos::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Materiel innexistant ! Probleme !'
            );
        }
        $q = $product->getQuantite() +1 ;
        $product->setQuantite($q);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
