<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Caracteristique;
use App\Entity\Choix;
use App\Entity\Niveau;
use App\Entity\Personnage;
use App\Entity\Scenario;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Creation des personnages
        $Personnage1 = new Personnage();
        $Personnage1->setNomPersonnage('Jacque');
        $manager->persist($Personnage1);

        $Caracteristique1 = new Caracteristique();
        $Caracteristique1->setIdPersonnage($Personnage1); // Relation ManyToOne
        $Caracteristique1->setAura('10');
        $Caracteristique1->setHumour('0');
        $Caracteristique1->setCharisme('0');
        $Caracteristique1->setPertinence('0');
        $Caracteristique1->setIntelligence('0');
        $manager->persist($Caracteristique1);
///////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Creation du scenario
        $Scenario1 = new Scenario();
        $Scenario1->setNomScenario('Objectif: Tremper le Biscuit');
        $Scenario1->setDescription("Un rendez-vous amoureux epique... ou totalement desastreux.");
        $manager->persist($Scenario1);

///////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Niveau 1 : L'arrivee au cafe
        $Niveau1 = new Niveau();
        $Niveau1->setNomNiveau('L Arrivee Epique');
        $Niveau1->setTextNiveau("Vous arrivez au cafe en retard de 15 minutes. Votre date vous fixe avec un sourire... legerement crispe.");
        $Niveau1->setLeScenario($Scenario1);
        $manager->persist($Niveau1);

        $Choix = new Choix();
         $Choix->setNomChoix('LeDebut');
         $Choix->setTextChoix('Connessance');
         $Choix->setLeNiveau($Niveau1);
         $manager->persist($Choix);

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

        $manager->flush();




    }
}