<?php

namespace App\Controller;

use App\Entity\Projets;
use App\Form\ProjetsType;
use App\Repository\ProjetsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProjetsController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin_projets")
     */
    public function index(ProjetsRepository $projetsRepository)
    {
        $projets = $projetsRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    /**
     * @Route("/admin/projets/create", name="projets_create")
     */
    public function createProjet(Request $request)
    {
        $projet = new Projets();

        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($projet);
                $manager->flush();
                $this->addFlash(
                    'success',
                    'La Projet a bien été ajoutée'
                );
            }
            else{
                $this->addFlash(
                    'danger',
                    'Une erreur est survenue'
                );
            }

            return $this->redirectToRoute('admin_projets');
        }

        return $this->render('admin/projetsForm.html.twig', [
            'formulaireProjet' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/projets/update-{id}", name="projets_update")
     */
    public function updateProjet(ProjetsRepository $ProjetsRepository, $id, Request $request)
    {
        $projet = $ProjetsRepository->find($id);

        $form = $this->createForm(ProjetsType::class, $projet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($projet);
            $manager->flush();
            $this->addFlash(
                'success',
                'La Projet a bien été modifiée'
            );
            return $this->redirectToRoute('admin_projets');
        }

        return $this->render('admin/projetsForm.html.twig', [
            'formulaireProjet' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/projets/delete-{id}", name="projets_delete")
     */
    public function deleteProjet(ProjetsRepository $ProjetsRepository, $id)
    {
        $projet = $ProjetsRepository->find($id);

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($projet);
        $manager->flush();

        $this->addFlash(
            'danger',
            'La Projet a bien été supprimée'
        );

        return $this->redirectToRoute('admin_projets');
    }
}
