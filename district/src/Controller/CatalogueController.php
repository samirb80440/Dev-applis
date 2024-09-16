<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;

class CatalogueController extends AbstractController
{
    private $categorieRepo;
    private $platRepo;

    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo)
    {
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $categories = $this->categorieRepo->findAll();
        $plat = $this->platRepo->findAll();

        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'categories' => $categories,
            'plat' => $plat,
        ]);
    }

    #[Route('/plats', name: 'app_plat')]
    public function Showplats(): Response
    {
        $plat = $this->platRepo->findAll();

        return $this->render('catalogue/plat.html.twig', [
            'controller_name' => 'CatalogueController',
            'plat' => $plat,
        ]);
    }

    #[Route('/plats/{categorie_id}', name: 'app_platcat', requirements:['categorie_id' =>'\d+'])]
    public function Showplatscat(int $categorie_id): Response
    {
        $categorie=$this->categorieRepo->find($categorie_id);

        $plat = $this->platRepo->findBy(['categorie' => $categorie->getId()]);
        return $this->render('catalogue/platcat.html.twig', [
            'controller_name' => 'CatalogueController',
            'plat'=>$plat,
            'categorie'=> $categorie
        ]);
    }

    #[Route('/categories', name: 'app_category')]
    public function Showcat(): Response
    {
        $categories = $this->categorieRepo->findAll();
        
        return $this->render('catalogue/category.html.twig', [
            'controller_name' => 'CatalogueController',
            'categories' => $categories,
        ]);
    }
}