<?php

namespace App\Form;

use App\Entity\Competition;
use App\Entity\Game;
use App\Entity\Location;
use App\Entity\Phase;
use App\Entity\Season;
use App\Entity\Team;
use App\Repository\CompetitionRepository;
use App\Repository\SeasonRepository;
use App\Repository\TeamRepository;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    private $teamRepository;
    private $competitionRepository;
    private $seasonRepository;

    public function __construct(
        TeamRepository $teamRepository, CompetitionRepository $competitionRepository, SeasonRepository $seasonRepository
    ){
        $this->teamRepository = $teamRepository;
        $this->competitionRepository = $competitionRepository;
        $this->seasonRepository = $seasonRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('competition', EntityType::class, [
                'choice_label'  => function ($entity) {
                    return $entity->getSport()->getName() . ' - ' .
                        $entity->getLocation()->getName() . ' - ' .
                        $entity->getName();
                },
                'choices' => $this->competitionRepository->getDisplayDropdown(),
                'class' => Competition::class,
                'label' => 'Select Competition: ',
                'placeholder' => '--Select--',
                'required' => true
            ])
            ->add('season', EntityType::class, [
                'class' => Season::class,
                'choices' => $this->seasonRepository->findBy([], ['id' => 'ASC']),
                'choice_label' => 'name',
                'label' => 'Select Season: ',
                'placeholder' => '--Select--',
                'required' => true
            ])
            ->add('team1', EntityType::class, [
                'choice_label'  => function ($entity) {
                    return $entity->getCompetition()->getName() . ' - ' .
                        $entity->getName();
                },
                'choices' => $this->teamRepository->getDisplayDropdown(),
                'class' => Team::class,
                'label' => 'Select Team1: ',
                'placeholder' => '--Select--',
                'required' => true
            ])
            ->add('team2', EntityType::class, [
                'choice_label'  => function ($entity) {
                    return $entity->getCompetition()->getName() . ' - ' .
                        $entity->getName();
                },
                'choices' => $this->teamRepository->getDisplayDropdown(),
                'class' => Team::class,
                'label' => 'Select Team2: ',
                'placeholder' => '--Select--',
                'required' => true
            ])
            ->add('phase', EntityType::class, [
                'class' => Phase::class,
                'choice_label' => 'name',
                'label' => 'Select Phase: ',
                'placeholder' => '--Select--',
                'required' => true
            ])
            ->add('observations')
            ->add('dateLastSeen')
            ->add('times_seen', IntegerType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 100
                ]
            ])
            ->add('funRate', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ],
                'required' => false
            ])
            ->add('historicRate', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ],
                'required' => false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
