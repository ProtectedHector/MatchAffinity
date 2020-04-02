<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Location;
use App\Entity\Sport;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
                'label' => 'Select Location: ',
                'placeholder' => '--Select--',
                'required' => false
            ])
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'choice_label' => 'name',
                'label' => 'Select Sport: ',
                'placeholder' => '--Select--',
                'required' => false
            ])
            ->add('multianual', ChoiceType::class, [
                'choices' => [
                    'Yes' => 1,
                    'No' => 0
                ],
                'label' => 'Multianual',
                'placeholder' => 'Select'
            ])
            ->add('iconNameWithExtension', TextType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
