<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Commande;

class TableDistrict extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

       $categoriepizza = new Categorie();
       $categoriepizza->setLibelle("Pizza");
       $categoriepizza->setImage("/images_the_district/category/pizza_cat.jpg");
       $categoriepizza->setActive("1");
       $manager->persist($categoriepizza);
     
     
     $categorieburger = new Categorie();
     $categorieburger->setLibelle("Burger");
     $categorieburger->setImage("/images_the_district/category/burger_cat.jp");
     $categorieburger->setActive("1");
     $manager->persist($categorieburger);




     $categoriewrap = new Categorie();
     $categoriewrap->setLibelle("Wrap");
     $categoriewrap->setImage("/images_the_district/category/wrap_cat.jpg");
     $categoriewrap->setActive("1");
     $manager->persist($categoriewrap);
     
     
     
     
        $manager->flush();
    }
}
