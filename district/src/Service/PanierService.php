<?php

namespace App\Service;

use App\Entity\Commande;
use App\Entity\Plat;
use App\Entity\User;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;

class PanierService
{
    private $requestStack;
    private $platRepository;

    public function __construct(RequestStack $requestStack, PlatRepository $platRepository)
    {
        $this->requestStack = $requestStack;
        $this->platRepository = $platRepository;
    }

    public function showPanier(): array
    {
        $session = $this->requestStack->getSession();

        return $session->get('panier', []);
    }

    public function showDataPanier(): array
    {
        $panier = $this->showPanier();
        $dataPanier = [];

        foreach ($panier as $id => $quantite) {
            $plat = $this->platRepository->find($id);
            if ($plat) {
                $dataPanier[] = [
                    "plat" => $plat,
                    "quantite" => $quantite
                ];
            }
        }

        return $dataPanier;
    }

    public function getTotal(): int
    {
        $panier = $this->showPanier();
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $plat = $this->platRepository->find($id);
            if ($plat) {
                $total += $plat->getPrix() * $quantite;
            }
        }

        return $total;
    }

    public function addOneDish(Plat $plat): void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);
        $id = $plat->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);
    }

    public function removeOneQuantity(Plat $plat): void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);
        $id = $plat->getId();

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);
    }

    public function deleteOneDish(Plat $plat): void
    {
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier', []);
        $id = $plat->getId();

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
    }

    public function deleteAllDish(): void
    {
        $session = $this->requestStack->getSession();
        $session->set('panier', []);
    }
}
