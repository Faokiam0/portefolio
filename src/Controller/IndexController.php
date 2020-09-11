<?php

namespace App\Controller;

use App\Repository\ProjetsRepository;
use App\Repository\CompetencesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProjetsRepository $projetsRepository)
    {
        $projets = $projetsRepository->findAll();

        return $this->render('index/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/competences", name="competences")
     */
    public function skill(CompetencesRepository $competencesRepository)
    {
        $technos = $competencesRepository->findByType("Technologie");
        $frameworks = $competencesRepository->findByType("Framework");
        $cms = $competencesRepository->findByType("CMS");

        $skills = ["Technologies" => $technos, "Frameworks" => $frameworks, "CMS" => $cms ];

        return $this->render('index/skills.html.twig', [
            'skills' => $skills
        ]);
    }

}
