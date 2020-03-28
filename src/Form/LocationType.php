<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Create Location (if it doesn't exist)"
            ])
//            ->add('existing', EntityType::class, [
//                'class' => Location::class,
//                'choice_label' => 'name',
//                'label' => 'Select Location: ',
//                'placeholder' => '--Select--',
//                'required' => false
//            ])
            ->add('submit', SubmitType::class)
        ;
    }
}
