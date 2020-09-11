<?php

namespace App\Form;

use App\Entity\Projets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, ['required' => true, 'label' => 'Nom du Projet  ', 'attr' => ['placeholder' => 'ex: Portefolio']])
            ->add('lien', TextType::class, ['required' => true, 'label' => 'Site du Projet  ', 'attr' => ['placeholder' => 'ex: https://www.portefolio.com']])
            ->add('description', TextareaType::class, ['required' => true, 'label' => 'Description du Projet  ', 'attr' => ['placeholder' => 'Une description succinte']])
            ->add('save', SubmitType::class, ['label' => 'Valider'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
        ]);
    }
}
