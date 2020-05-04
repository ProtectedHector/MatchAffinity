<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Team;
use App\Repository\CompetitionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends AbstractType
{
    /**
     * @var CompetitionRepository
     */
    private $competitionRepository;

    public function __construct(CompetitionRepository $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

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
                'choice_label' => function ($entity) {
                    return $entity->getSport()->getName() . ' - ' .
                        $entity->getLocation()->getName() . ' - ' .
                        $entity->getName();
                },
                'choices' => $this->competitionRepository->getDisplayDropdown(),
                'class' => Competition::class,
                'label' => 'Select Competition: ',
                'placeholder' => '--Select--',
                'required' => true,
                'attr' => [
                    'class' => 'custom-select'
                ]
            ])
            ->add('flagPath', TextType::class, [
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
