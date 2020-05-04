<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Location;
use App\Entity\Sport;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Name: '
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
                'label' => 'Select Location: ',
                'placeholder' => '--Select--',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'choice_label' => 'name',
                'label' => 'Select Sport: ',
                'placeholder' => '--Select--',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('multianual', ChoiceType::class, [
                'choices' => [
                    'Yes' => 1,
                    'No' => 0
                ],
                'label' => 'Multianual',
                'placeholder' => 'Select',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('flagPath', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
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
            'data_class' => Competition::class,
        ]);
    }
}
