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
    
    // AJOUT PLUS UN A LA QUANTITE
    #[Route('/plus/{id}', name: 'plusOne', requirements: ['id' => '\d+'])]
    public function updatePlusOne(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Matos::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Materiel innexistant ! Probleme !'
            );
        }
        $q = $product->getQuantite() + 1;
        $product->setQuantite($q);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    // RETIRE UN A LA QUANTITE
    #[Route('/moins/{id}', name: 'minusOne', requirements: ['id' => '\d+'])]
    public function updateMinusOne(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Matos::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Materiel innexistant ! Probleme !'
            );
        }
        $q = $product->getQuantite() - 1;
        $product->setQuantite($q);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    // Création d'un matériel
    #[Route('creer', name: 'creerOne')]
    public function creerOne() {
        
    }

    //Edition de materiel

    #[Route('edit/{id}', name: 'editOne', requirements: ['id' => '\d+'])]
    public function editOne(Matos $matos, Request $request, EntityManagerInterface $em) {

    }

    // SUPPRIME LE MATERIEL
    #[Route('/suppr/{id}', name: 'supprOne', requirements: ['id' => '\d+'])]
    public function supprOne(EntityManagerInterface $entityManager, int $id): Response
    {
        $product = $entityManager->getRepository(Matos::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'Materiel innexistant ! Probleme !'
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
