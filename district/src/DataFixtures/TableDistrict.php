<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Categorie;
use App\Entity\Plat;
use App\Entity\Detail;
use App\Entity\User;
use App\Entity\Commande;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TableDistrict extends Fixture
{   
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }


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
        $categorieburger->setImage("burger_cat.jpg");
        $categorieburger->setActive("Yes");
        $manager->persist($categorieburger);


        $categoriewrap = new Categorie();
        $categoriewrap->setLibelle("Wrap");
        $categoriewrap->setImage("wrap_cat.jpg");
        $categoriewrap->setActive("Yes");
        $manager->persist($categoriewrap);


        $categoriepasta = new Categorie();
        $categoriepasta->setLibelle("Pasta");
        $categoriepasta->setImage("pasta_cat.jpg");
        $categoriepasta->setActive("Yes");
        $manager->persist($categoriepasta);



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
        $platPizzaBianca->setCategorie($categoriepizza);
        $manager->persist($platPizzaBianca);



        $platPizzaMargherita = new Plat();
        $platPizzaMargherita->setLibelle("Pizza Margherita");
        $platPizzaMargherita->setDescription("Une authentique pizza margarita, un classique de la cuisine italienne! Une pâte faite maison, une sauce tomate fraîche, de la mozzarella Fior di latte, du basilic, origan, ail, sucre, sel & poivre...");
        $platPizzaMargherita->setPrix("14.00");
        $platPizzaMargherita->setImage("pizza-margherita.jpg");
        $platPizzaMargherita->setActive("Yes");
        $platPizzaMargherita->setCategorie($categoriepizza);
        $manager->persist($platPizzaMargherita);



        $platDistrictBurger = new Plat();
        $platDistrictBurger->setLibelle("District Burger");
        $platDistrictBurger->setDescription("Burger composé d’un bun’s du boulanger, deux steaks de 80g (origine française), de deux tranches poitrine de porc fumée, de deux tranches cheddar affiné, salade et oignons confits...");
        $platDistrictBurger->setPrix("8.00");
        $platDistrictBurger->setImage("hamburger.jpg");
        $platDistrictBurger->setActive("Yes");
        $platDistrictBurger->setCategorie($categorieburger);
        $manager->persist($platDistrictBurger);


        $platCheesburger = new Plat();
        $platCheesburger->setLibelle("Cheeseburger");
        $platCheesburger->setDescription("Burger composé d’un bun’s du boulanger, de salade, oignons rouges, pickles, oignon confit, tomate, d’un steak d’origine Française, d’une tranche de cheddar affiné, et de notre sauce maison.");
        $platCheesburger->setPrix("8.00");
        $platCheesburger->setImage("cheesburger.jpg");
        $platCheesburger->setActive("Yes");
        $platCheesburger->setCategorie($categorieburger);
        $manager->persist($platCheesburger);



        $platBuffaloChickenWrap = new Plat();
        $platBuffaloChickenWrap->setLibelle("Buffalo Chicken Wrap");
        $platBuffaloChickenWrap->setDescription("Du bon filet de poulet mariné dans notre spécialité sucrée & épicée, enveloppé dans une tortilla blanche douce faite maison.");
        $platBuffaloChickenWrap->setPrix("5.00");
        $platBuffaloChickenWrap->setImage("buffalo-chicken.webp");
        $platBuffaloChickenWrap->setActive("Yes");
        $platBuffaloChickenWrap->setCategorie($categoriewrap);
        $manager->persist($platBuffaloChickenWrap);



        $platSpaghettiLegumes = new Plat();
        $platSpaghettiLegumes->setLibelle("Spaghetti aux légumes");
        $platSpaghettiLegumes->setDescription("Un plat de spaghetti au pesto de basilic et légumes poêlés, très parfumé et rapide.");
        $platSpaghettiLegumes->setPrix("10.00");
        $platSpaghettiLegumes->setImage("spaghetti-legumes.jpg");
        $platSpaghettiLegumes->setActive("Yes");
        $platSpaghettiLegumes->setCategorie($categoriepasta);
        $manager->persist($platSpaghettiLegumes);



        $platsLasagnes = new Plat();
        $platsLasagnes->setLibelle("Lasagnes");
        $platsLasagnes->setDescription("Découvrez notre recette des lasagnes, l'une des spécialités italiennes que tout le monde aime avec sa viande hachée et gratinée à l'emmental. Et bien sûr, une inoubliable béchamel à la noix de muscade.");
        $platsLasagnes->setPrix("12.00");
        $platsLasagnes->setImage("lasagnes_viande.jpg");
        $platsLasagnes->setActive("Yes");
        $platsLasagnes->setCategorie($categoriepasta);
        $manager->persist($platsLasagnes);



        $platsTagliatellesSaumon = new Plat();
        $platsTagliatellesSaumon->setLibelle("Tagliatelles au saumon");
        $platsTagliatellesSaumon->setDescription("Découvrez notre recette délicieuse de tagliatelles au saumon frais et à la crème qui qui vous assure un véritable régal !");
        $platsTagliatellesSaumon->setPrix("12.00");
        $platsTagliatellesSaumon->setImage("tagliatelles_saumon.webp");
        $platsTagliatellesSaumon->setActive("Yes");
        $platsTagliatellesSaumon->setCategorie($categoriepasta);
        $manager->persist($platsTagliatellesSaumon);



        $platsSaladeCesar = new Plat();
        $platsSaladeCesar->setLibelle("Salade César");
        $platsSaladeCesar->setDescription("Une délicieuse salade Caesar (César) composée de filets de poulet grillés, de feuilles croquantes de salade romaine, de croutons à l'ail, de tomates cerise et surtout de sa fameuse sauce Caesar. Le tout agrémenté de copeaux de parmesan.");
        $platsSaladeCesar->setPrix("7.00");
        $platsSaladeCesar->setImage("cesar_salad.jpg");
        $platsSaladeCesar->setActive("Yes");
        $platsSaladeCesar->setCategorie($categorieSalade);
        $manager->persist($platsSaladeCesar);


        $user1= new User();
        $user1->setEmail('random@gmail.com');
        $user1->setPassword('lol');
        
        $Password1='lol';
        $hashedPassword= $this->passwordHasher->hashPassword(
            $user1,
            $Password1
        );
        $user1->setPassword($hashedPassword);
        $user1->setNom('Rand');
        $user1->setPrenom('Rando');
        $user1->setTelephone('0619600722');
        $user1->setAdresse('12 rue de la paix');
        $user1->setCp('80000');
        $user1->setVille('Amiens');
        $user1->setRoles(['ROLE_ADMIN']);
        
        $manager->persist($user1);

        $user2= new User();
        $user2->setEmail('cacao@yahoo.com');
        $Password ='cacao';
        $hashedPassword= $this->passwordHasher->hashPassword(
            $user2,
            $Password
        );
        $user2->setPassword($hashedPassword);
        $user2->setNom('Cacao');
        $user2->setPrenom('Bernard');
        $user2->setTelephone('0449452282');
        $user2->setAdresse('21 rue quatre cailloux'); // Fix the typo here
        $user2->setCp('80000');
        $user2->setVille('Amiens');
        $user2->setRoles(['ROLE_CHEF']);
        $manager->persist($user2);



        $commande1= new Commande();
        $commande1->setDateCommande(new \DateTimeImmutable());
        $commande1->setTotal($platDistrictBurger->getPrix());
        $commande1->setEtat(3);
        $commande1->setUser($user1);
        
        $manager->persist($commande1);

       $commande2= new Commande();
       $commande2->setDateCommande(new \DateTimeImmutable());
       $commande2->setTotal($platPizzaBianca->getPrix()+$platSpaghettiLegumes->getprix());
       $commande2->setEtat(2);
       $commande2->setUser($user2);

       $manager->persist($commande2);


       $detail1 = new Detail();
       $detail1->setQuantite(1);
       $detail1->setCommande($commande1);
       $detail1->setPlat($platDistrictBurger);

       $manager->persist($detail1);

       $detail2 = new Detail();
       $detail2->setQuantite(1);
       $detail2->setCommande($commande2);
       $detail2->setPlat($platPizzaBianca);

       $manager->persist($detail2);

       $detail3 = new Detail();
       $detail3->setQuantite(1);
       $detail3->setCommande($commande2);
       $detail3->setPlat($platSpaghettiLegumes);

       $manager->persist($detail3);
      





        $manager->flush();
    }
}
