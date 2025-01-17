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
        // Creation du scenario
        $Scenario1 = new Scenario();
        $Scenario1->setNomScenario('Tremper le biscuit');
        $Scenario1->setDescription("Un rendez-vous ou tout peut basculer. Elle, une femme elegante et intelligente, passionnee par l art, les voyages, et les discussions profondes. Sa faiblesse ? Un sens de l humour audacieux et un charme authentique. Saurez-vous capter son attention et gagner son coeur ?");
        $manager->persist($Scenario1);


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////
        // Niveau 1 : L'arrivee au cafe
        $Niveau1 = new Niveau();
        $Niveau1->setNomNiveau('L Arrivee Epique');
        $Niveau1->setTextNiveau("Vous arrivez au cafe en retard de 15 minutes. Votre date vous fixe avec un sourire... legerement crispe.");
        $Niveau1->setNomNiveau('L Arrivee Epique');
        $Niveau1->setTextNiveau("Vous arrivez au cafe en retard de 15 minutes. Votre date vous fixe avec un sourire... legerement crispe.");
        $Niveau1->setLeScenario($Scenario1);
        $manager->persist($Niveau1);

        // Choix du Niveau 1
        $Choix1_1 = new Choix();
        $Choix1_1->setNomChoix("Vous dites : « Desole, j ai croise un chat qui ressemblait trop à mon ex, ça m a trouble. »");
        $Choix1_1->setTextChoix("Elle se vexe, vous jette un verre d'eau et quitte le restaurant en colère.");
        $Choix1_1->setConsequenceChoix(["-10", "+1", "-3", "-1", "+1"]);
        $Choix1_1->setLeNiveau($Niveau1);
        $manager->persist($Choix1_1);

        $Choix1_2 = new Choix();
        $Choix1_2->setNomChoix("Vous arrivez en courant, glissez sur le carrelage, et atterrissez sur les genoux avec une rose entre les dents.");
        $Choix1_2->setTextChoix("Elle eclate de rire, applaudit et semble conquise par votre humour et votre entree spectaculaire.");
        $Choix1_2->setConsequenceChoix(["+3", "+3", "+2", "0", "-1"]);
        $Choix1_2->setLeNiveau($Niveau1);
        $manager->persist($Choix1_2);

        $Choix1_3 = new Choix();
        $Choix1_3->setNomChoix("Vous ne dites rien, vous vous asseyez et commencez à lire le menu comme si de rien n etait.");
        $Choix1_3->setTextChoix("Elle vous fixe avec un regard glacial et croise les bras. L'ambiance devient très tendue.");
        $Choix1_3->setConsequenceChoix(["-3", "0", "-2", "-3", "0"]);
        $Choix1_3->setLeNiveau($Niveau1);
        $manager->persist($Choix1_3);

        $Choix1_4 = new Choix();
        $Choix1_4->setNomChoix("Vous dites : « Desole pour le retard, leg day à la salle, mes jambes tremblent encore. Mais t inquiète, je suis en pleine forme pour toi. »");
        $Choix1_4->setTextChoix("Elle sourit, flattee par votre remarque, et semble amusee par votre excuse sportive.");
        $Choix1_4->setConsequenceChoix(["+3", "+2", "+3", "0", "+2"]);
        $Choix1_4->setLeNiveau($Niveau1);
        $manager->persist($Choix1_4);

        $Choix1_5 = new Choix();
        $Choix1_5->setNomChoix("Vous arrivez habille en trench-coat noir, lunettes de soleil, et murmurez : « On ne parle pas du pourquoi je suis en retard... pour ta securite. »");
        $Choix1_5->setTextChoix("Elle eclate de rire mais reste perplexe, visiblement intriguee par votre mysterieuse entree.");
        $Choix1_5->setConsequenceChoix(["1", "+1", "+2", "+2", "0"]);
        $Choix1_5->setLeNiveau($Niveau1);
        $manager->persist($Choix1_5);

        $Choix1_6 = new Choix();
        $Choix1_6->setNomChoix("Vous arrivez avec un donut à la main et dites : « J ai dû me battre pour ça, mais ça en valait la peine. »");
        $Choix1_6->setTextChoix("Elle sourit et accepte le donut avec plaisir, touchee par votre geste attentionne.");
        $Choix1_6->setConsequenceChoix(["+2", "+1", "+1", "+1", "0"]);
        $Choix1_6->setLeNiveau($Niveau1);
        $manager->persist($Choix1_6);


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Niveau 2 : La commande
        $Niveau2 = new Niveau();
        $Niveau2->setNomNiveau('La Commande');
        $Niveau2->setTextNiveau("Le serveur arrive pour prendre votre commande. Votre date hesite a choisir entre un cafe ou un smoothie.");
        $Niveau2->setLeScenario($Scenario1);
        $manager->persist($Niveau2);

        // Choix du Niveau 2
        $Choix2_1 = new Choix();
        $Choix2_1->setNomChoix("Vous dites au serveur : « Elle prendra un cafe noir comme son âme. »");
        $Choix2_1->setTextChoix("Elle vous regarde avec un sourire force, mais visiblement vexee par votre commentaire.");
        $Choix2_1->setConsequenceChoix(["-3", "+1", "+2", "-2", "0"]);
        $Choix2_1->setLeNiveau($Niveau2);
        $manager->persist($Choix2_1);

        $Choix2_2 = new Choix();
        $Choix2_2->setNomChoix("Vous commandez : « Un lait de chèvre bio avec un soupçon de miel et de l amour, s il vous plaît. »");
        $Choix2_2->setTextChoix("Elle eclate de rire, amusee par votre audace, mais trouve cela un peu etrange.");
        $Choix2_2->setConsequenceChoix(["+2", "+1", "+1", "+1", "-1"]);
        $Choix2_2->setLeNiveau($Niveau2);
        $manager->persist($Choix2_2);

        $Choix2_3 = new Choix();
        $Choix2_3->setNomChoix("Vous attendez sans rien dire. L ambiance devient... gênante.");
        $Choix2_3->setTextChoix("Elle detourne les yeux, visiblement mal à l aise par le silence pesant.");
        $Choix2_3->setConsequenceChoix(["-2", "-1", "-3", "0", "0"]);
        $Choix2_3->setLeNiveau($Niveau2);
        $manager->persist($Choix2_3);

        $Choix2_4 = new Choix();
        $Choix2_4->setNomChoix("Vous demandez au serveur : « Surprenez-nous avec ce qu il y a de plus extravagant dans le menu. »");
        $Choix2_4->setTextChoix("Elle sourit, curieuse de voir ce que vous avez commande, et apprecie votre spontaneite.");
        $Choix2_4->setConsequenceChoix(["+1", "0", "+1", "+2", "0"]);
        $Choix2_4->setLeNiveau($Niveau2);
        $manager->persist($Choix2_4);

        $Choix2_5 = new Choix();
        $Choix2_5->setNomChoix("Vous commandez : « Deux cocktails maison et un dessert partage pour commencer en beaute. »");
        $Choix2_5->setTextChoix("Elle est impressionnee par votre choix audacieux et semble apprecier l idee.");
        $Choix2_5->setConsequenceChoix(["+3", "0", "+2", "+1", "+2"]);
        $Choix2_5->setLeNiveau($Niveau2);
        $manager->persist($Choix2_5);



        ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        $Niveau3 = new Niveau();
        $Niveau3->setNomNiveau('Discussion');
        $Niveau3->setTextNiveau("Votre date vous demande : « Et toi, tu fais quoi dans la vie ? » C est l occasion de briller ou de surprendre.");
        $Niveau3->setLeScenario($Scenario1);
        $manager->persist($Niveau3);

        // Choix du Niveau 3

        $Choix3_1 = new Choix();
        $Choix3_1->setNomChoix("Vous repondez : « Je suis un designer de jeux video, je cree des mondes où tout est possible. »");
        $Choix3_1->setTextChoix("Elle fait une grimace, visiblement degoûtee. « Ah, encore un geek qui passe sa vie derrière un ecran… »");
        $Choix3_1->setConsequenceChoix(["-5", "-3", "-4", "0", "-2"]);
        $Choix3_1->setLeNiveau($Niveau3);
        $manager->persist($Choix3_1);


        $Choix3_2 = new Choix();
        $Choix3_2->setNomChoix("Vous repondez : « Je suis dresseur d abeilles pour des scènes de cinema. Oui, c est un vrai metier. »");
        $Choix3_2->setTextChoix("Elle eclate de rire et semble fascinee par votre metier hors du commun.");
        $Choix3_2->setConsequenceChoix(["+2", "+2", "+1", "+2", "-2"]);
        $Choix3_2->setLeNiveau($Niveau3);
        $manager->persist($Choix3_2);

        $Choix3_3 = new Choix();
        $Choix3_3->setNomChoix("Vous repondez avec un sourire mysterieux : « Je suis acteur dans le X... mais seulement pour les scènes avec un scenario. »");
        $Choix3_3->setTextChoix("Elle rougit, eclate de rire, et semble intriguee par votre humour audacieux.");
        $Choix3_3->setConsequenceChoix(["+1", "+3", "0", "+2", "+2"]);
        $Choix3_3->setLeNiveau($Niveau3);
        $manager->persist($Choix3_3);

        $Choix3_4 = new Choix();
        $Choix3_4->setNomChoix("Vous repondez : « C est complique, mais disons que j aide les gens à realiser leurs reves. »");
        $Choix3_4->setTextChoix("Elle vous ecoute attentivement, intriguee et charmee par votre mystere.");
        $Choix3_4->setConsequenceChoix(["+1", "0", "+1", "+1", "+1"]);
        $Choix3_4->setLeNiveau($Niveau3);
        $manager->persist($Choix3_4);

        $Choix3_5 = new Choix();
        $Choix3_5->setNomChoix("Vous repondez : « Je bosse dans la compta. Pas très excitant, mais ça paie les factures. »");
        $Choix3_5->setTextChoix("Elle sourit poliment, mais semble un peu deçue par votre reponse terre-à-terre.");
        $Choix3_5->setConsequenceChoix(["-2", "+1", "0", "-4", "+1"]);
        $Choix3_5->setLeNiveau($Niveau3);
        $manager->persist($Choix3_5);


        ///////////////////////////////////////////////////////////////////////////////////////////////////////////

        // Niveau 4 : Le moment de verite
        $Niveau4 = new Niveau();
        $Niveau4->setNomNiveau('Le Moment de Verite');
        $Niveau4->setTextNiveau("La soiree touche a sa fin. C est le moment de conclure.");
        $Niveau4->setLeScenario($Scenario1);
        $manager->persist($Niveau4);

        // Choix du Niveau 4
        $Choix4_1 = new Choix();
        $Choix4_1->setNomChoix("Vous approchez doucement, les yeux mi-clos, un chewing-gum à moitie mâche entre vos dents.");
        $Choix4_1->setTextChoix("Elle recule legerement, confuse, mais semble amusee par votre tentative maladroite.");
        $Choix4_1->setConsequenceChoix(["-4", "0", "-2", "0", "+1"]);
        $Choix4_1->setLeNiveau($Niveau4);
        $manager->persist($Choix4_1);

        $Choix4_2 = new Choix();
        $Choix4_2->setNomChoix("Vous lui proposez : « Si tu veux, on peut aller chez moi... J ai une super collection de memes. »");
        $Choix4_2->setTextChoix("Elle eclate de rire et accepte votre proposition, intriguee par votre humour.");
        $Choix4_2->setConsequenceChoix(["+2", "+3", "0", "+1", "0"]);
        $Choix4_2->setLeNiveau($Niveau4);
        $manager->persist($Choix4_2);

        $Choix4_3 = new Choix();
        $Choix4_3->setNomChoix("Vous pretextez un appel urgent de votre grand-mère pour eviter un echec potentiel.");
        $Choix4_3->setTextChoix("Elle semble deçue, mais accepte votre depart precipite sans poser de questions.");
        $Choix4_3->setConsequenceChoix(["-3", "+1", "0", "+2", "+1"]);
        $Choix4_3->setLeNiveau($Niveau4);
        $manager->persist($Choix4_3);

        $Choix4_4 = new Choix();
        $Choix4_4->setNomChoix("Vous dites : « Avant que tu partes, sache que je suis peut-être le heros dont ce monde a besoin. »");
        $Choix4_4->setTextChoix("Elle rit doucement, un peu gênee, mais semble intriguee par votre declaration.");
        $Choix4_4->setConsequenceChoix(["+2", "+1", "+2", "+1", "+1"]);
        $Choix4_4->setLeNiveau($Niveau4);
        $manager->persist($Choix4_4);

        $Choix4_5 = new Choix();
        $Choix4_5->setNomChoix("Vous proposez une danse lente dans un cafe vide en disant : « Pourquoi pas rendre cette soiree inoubliable ? »");
        $Choix4_5->setTextChoix("Elle accepte avec un sourire, visiblement emue par votre geste romantique.");
        $Choix4_5->setConsequenceChoix(["+4", "0", "+2", "0", "+1"]);
        $Choix4_5->setLeNiveau($Niveau4);
        $manager->persist($Choix4_5);



        ///////////////////////////////////////////////////////////////////

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
