<?php

namespace App\DataFixtures;

use App\Entity\Projets;
use App\Entity\Competences;
use App\Entity\Comptetences;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        
        // Projet 1
        $projet = new Projets();
        $projet->setNom("Karate91");
        $projet->setLien("");
        $projet->setDescription("");
        $manager->persist($projet);

        // Compétences
        $skill = new Comptetences();
        $skill->setNom("HTML");
        $skill->setType("Langage");
        $manager->persist($skill);

        // Flush
        $manager->flush();
    }
}
