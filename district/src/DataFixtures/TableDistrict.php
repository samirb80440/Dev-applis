<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Plat;

class TableDistrict extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $categoriepizza = new Categorie();
        $categoriepizza->setLibelle("Pizza");
        $categoriepizza->setImage("pizza_cat.jpg");
        $categoriepizza->setActive("Yes");
        $manager->persist($categoriepizza);


        $categorieburger = new Categorie();
        $categorieburger->setLibelle("Burger");
        $categorieburger->setImage("burger_cat.jp");
        $categorieburger->setActive("Yes");
        $manager->persist($categorieburger);




        $categoriepasta = new Categorie();
        $categoriepasta->setLibelle("Wrap");
        $categoriepasta->setImage("pasta_cat.jpg");
        $categoriepasta->setActive("Yes");
        $manager->persist($categoriepasta);



        $categoriePasta = new Categorie();
        $categoriePasta->setLibelle("Pasta");
        $categoriePasta->setImage("wrap_cat.jpg");
        $categoriePasta->setActive("Yes");
        $manager->persist($categoriePasta);



        $categorieSandwich = new Categorie();
        $categorieSandwich->setLibelle("Sandwich");
        $categorieSandwich->setImage("sandwich_cat.jpg");
        $categorieSandwich->setActive("Yes");
        $manager->persist($categorieSandwich);



        $categorieSalade = new Categorie();
        $categorieSalade->setLibelle("Salade");
        $categorieSalade->setImage("salade_cat.jpg");
        $categorieSalade->setActive("Yes");
        $manager->persist($categorieSalade);




        $platPizzaBianca = new Plat();
        $platPizzaBianca->setLibelle("Pizza Bianca");
        $platPizzaBianca->setDescription("Une pizza fine et croustillante garnie de crème mascarpone légèrement citronnée et de tranches de saumon fumé, le tout relevé de baies roses et de basilic frais.");
        $platPizzaBianca->setPrix("14.00");
        $platPizzaBianca->setImage("pizza-salmon.png");
        $platPizzaBianca->setActive("Yes");
        $manager->persist($platPizzaBianca);



        $platPizzaMargherita = new Plat();
        $platPizzaMargherita->setLibelle("Pizza Margherita");
        $platPizzaMargherita->setDescription("Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...");
        $platPizzaMargherita->setPrix("14.00");
        $platPizzaMargherita->setImage("pizza-margherita.jpg");
        $platPizzaMargherita->setActive("Yes");
        $manager->persist($platPizzaMargherita);



        $platDistrictBurger = new Plat();
        $platDistrictBurger->setLibelle("District Burger");
        $platDistrictBurger->setDescription("Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits...");
        $platDistrictBurger->setPrix("8.00");
        $platDistrictBurger->setImage("hamburger.jpg");
        $platDistrictBurger->setActive("Yes");
        $manager->persist($platDistrictBurger);


        $platCheesburger = new Plat();
        $platCheesburger->setLibelle("Cheeseburger");
        $platCheesburger->setDescription("Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.");
        $platCheesburger->setPrix("8.00");
        $platCheesburger->setImage("cheesburger.jpg");
        $platCheesburger->setActive("Yes");
        $manager->persist($platCheesburger);



        $platBuffaloChickenWrap = new Plat();
        $platBuffaloChickenWrap->setLibelle("Buffalo Chicken Wrap");
        $platBuffaloChickenWrap->setDescription("Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.");
        $platBuffaloChickenWrap->setPrix("5.00");
        $platBuffaloChickenWrap->setImage("buffalo-chicken.webp");
        $platBuffaloChickenWrap->setActive("Yes");
        $manager->persist($platBuffaloChickenWrap);



        $platSpaghettiLegumes = new Plat();
        $platSpaghettiLegumes->setLibelle("Spaghetti aux légumes");
        $platSpaghettiLegumes->setDescription("Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide.");
        $platSpaghettiLegumes->setPrix("10.00");
        $platSpaghettiLegumes->setImage("spaghetti-legumes.jpg");
        $platSpaghettiLegumes->setActive("Yes");
        $manager->persist($platSpaghettiLegumes);



        $platsLasagnes = new Plat();
        $platsLasagnes->setLibelle("Lasagnes");
        $platsLasagnes->setDescription("Découvrez notre recette des lasagnes, l'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.");
        $platsLasagnes->setPrix("12.00");
        $platsLasagnes->setImage("lasagnes_viande.jpg");
        $platsLasagnes->setActive("Yes");
        $manager->persist($platsLasagnes);



        $platsTagliatellesSaumon = new Plat();
        $platsTagliatellesSaumon->setLibelle("Tagliatelles au saumon");
        $platsTagliatellesSaumon->setDescription("Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal !");
        $platsTagliatellesSaumon->setPrix("12.00");
        $platsTagliatellesSaumon->setImage("tagliatelles_saumon.webp");
        $platsTagliatellesSaumon->setActive("Yes");
        $manager->persist($platsTagliatellesSaumon);



        $platsSaladeCesar = new Plat();
        $platsSaladeCesar->setLibelle("Salade César");
        $platsSaladeCesar->setDescription("Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.");
        $platsSaladeCesar->setPrix("7.00");
        $platsSaladeCesar->setImage("cesar_salade.jpg");
        $platsSaladeCesar->setActive("Yes");
        $manager->persist($platsSaladeCesar);


        $manager->flush();
    }
}
