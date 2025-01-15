<?php

namespace App\DataFixtures;

<<<<<<< HEAD
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Caracteristique;
use App\Entity\Choix;
use App\Entity\Niveau;
use App\Entity\Personnage;
use App\Entity\Scenario;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $Personnage1 = new Personnage();
        $Personnage1->setNomPersonnage('Jacque');
        $manager->persist($Personnage1);

        $Personnage2 = new Personnage();
        $Personnage2->setNomPersonnage('Franck');
        $manager->persist($Personnage2);

        $Caracteristique1 = new Caracteristique();
        $Caracteristique1->setIdPersonnage($Personnage1);
        $Caracteristique1->setAura('10');
        $Caracteristique1->setHumour('10');
        $Caracteristique1->setCharisme('10');
        $Caracteristique1->setPertinence('10');
        $Caracteristique1->setIntelligence('10');
        $manager->persist($Caracteristique1);


        $Scenario1 = new Scenario();
        $Scenario1->setNomScenario('TheDate');
        $Scenario1->setDescription('Objectif: treper le biscuit');
        $manager->persist($Scenario1);

        $Niveau1 = new Niveau();
        $Niveau1->setNomNiveau('LeDebut');
        $Niveau1->setTextNiveau('Connessance');
        $Niveau1->setLeScenario($Scenario1);
        $manager->persist($Niveau1);

        $Choix = new Choix();
         $Choix->setNomChoix('LeDebut');
         $Choix->setTextChoix('Connessance');
         $Choix->setLeNiveau($Niveau1);
         $manager->persist($Choix);




        // $product = new Product();
        // $manager->persist($product);

=======
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager, ): void
    {
        $user1 = new User();
        $user1->setUsername('Admin');
        $hashedPassword = $this->passwordHasher->hashPassword($user1, 'admin');
        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_ADMIN']);
        $manager->persist($user1);


        $user2 = new User();
        $user2->setUsername('User');
        $hashedPassword = $this->passwordHasher->hashPassword($user2, 'user');
        $user2->setPassword($hashedPassword);
        $user2->setRoles(['ROLE_USER']);
        $manager->persist($user2);
        
>>>>>>> f067344 (login page)
        $manager->flush();
    }
}
