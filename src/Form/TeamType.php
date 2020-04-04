<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Team Name: '
            ])
            ->add('competition', EntityType::class, [
                'class' => Competition::class,
                'choice_label' => 'name',
                'label' => 'Select Competition: ',
                'placeholder' => '--Select--',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('teamFlagPath', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Team Flag Path: '
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
