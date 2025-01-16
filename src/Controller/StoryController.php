<?php

namespace App\Controller;

use App\Entity\Choix;
use App\Entity\Niveau;
use App\Entity\Scenario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class StoryController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/story', name: 'story')]
    public function index(): Response
    {
        $scenarios = $this->entityManager->getRepository(Scenario::class)->findAll();

        // Générer les slugs pour chaque scénario
        $scenariosWithSlugs = array_map(function ($scenario) {
            return [
                'scenario' => $scenario,
                'slug' => $this->slugify($scenario->getNomScenario())
            ];
        }, $scenarios);

        return $this->render('story/index.html.twig', [
            'scenarios' => $scenariosWithSlugs,
        ]);
    }

    #[Route('/story/{slug}/{niveauId?}', name: 'story_show')]
    public function show(string $slug, ?int $niveauId = null): Response
    {
        $scenario = $this->entityManager->getRepository(Scenario::class)->findOneBy(['NomScenario' => str_replace('-', ' ', $slug)]);

        if (!$scenario) {
            throw $this->createNotFoundException('Le scénario n\'existe pas');
        }

        // Récupérer le niveau actuel ou le premier niveau si aucun niveauId n'est fourni
        if ($niveauId === null) {
            $niveau = $scenario->getLesNiveaux()->first();
        } else {
            $niveau = $this->entityManager->getRepository(Niveau::class)->find($niveauId);
        }

        if (!$niveau) {
            throw $this->createNotFoundException('Aucun niveau trouvé pour ce scénario');
        }

        // Récupérer les choix du niveau
        $choix = $niveau->getLesChoix();

        return $this->render('story/show.html.twig', [
            'scenario' => $scenario,
            'niveau' => $niveau,
            'choix' => $choix,
        ]);
    }

    #[Route('/story/{slug}/{niveauId}/{choixId}', name: 'story_choix')]
    public function choix(string $slug, int $niveauId, int $choixId): Response
    {
        $scenario = $this->entityManager->getRepository(Scenario::class)->findOneBy(['NomScenario' => str_replace('-', ' ', $slug)]);
        $niveau = $this->entityManager->getRepository(Niveau::class)->find($niveauId);
        $choix = $this->entityManager->getRepository(Choix::class)->find($choixId);

        if (!$scenario || !$niveau || !$choix) {
            throw $this->createNotFoundException('Le scénario, le niveau ou le choix n\'existe pas');
        }

        // Déterminer le niveau suivant (logique à adapter selon votre modèle de données)
        $nextNiveau = $this->entityManager->getRepository(Niveau::class)->find($niveauId + 1);

        if (!$nextNiveau) {
            return $this->render('story/end.html.twig', [
                'scenario' => $scenario,
            ]);
        }

        return $this->redirectToRoute('story_show', [
            'slug' => $slug,
            'niveauId' => $nextNiveau->getId(),
        ]);
    }
    private function slugify(string $text): string
    {
        // Remplace les espaces par des tirets
        $text = str_replace(' ', '-', $text);
        // Supprime les caractères non alphanumériques
        $text = preg_replace('/[^A-Za-z0-9\-]/', '', $text);
        // Convertit en minuscules
        return strtolower($text);
    }
}
