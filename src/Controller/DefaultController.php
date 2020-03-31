<?php


namespace App\Controller;


use App\Entity\Competition;
use App\Entity\Link;
use App\Entity\Location;
use App\Entity\Game;
use App\Entity\Phase;
use App\Entity\Season;
use App\Entity\Sport;
use App\Entity\Team;
use App\Entity\User;
use App\Form\CompetitionType;
use App\Form\GameType;
use App\Form\LinkType;
use App\Form\LocationType;
use App\Form\PhaseType;
use App\Form\SeasonType;
use App\Form\SportType;
use App\Form\TeamType;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/game/list", name="list")
     */
    public function listGames()
    {
        $games = $this->getDoctrine()->getRepository(Game::class)->getSortedList();

        return $this->render('game_list.html.twig', [
            'games' => $games
        ]);
    }

    /**
     * @Route("/game/add", name="add_game")
     */
    public function addGameFlow()
    {
        $gameFlowSteps = [
            'add_location',
            'add_competition',
            'add_season',
            'add_team1',
            'add_team2',
            'add_phase',
            'add_game'
        ];

        $this->get('session')->set('new-game', new Game());

        return $this->redirectToRoute($gameFlowSteps[0]);
    }

    /**
     * @Route("/game/location", name="add_location")
     * @param Request $request
     * @return Response
     */
    public function addLocation(Request $request)
    {
        $form = $this->createForm(LocationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('existing')) {
                /** @var Game $newGame */
                $newGame = $this->get('session')->get('new-game');
                // $newGame->
            }
        }

        return $this->render('game_location.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/location/new", name="new_location")
     * @param Request $request
     * @return Response
     */
    public function newLocation(Request $request)
    {
        $location = new Location();
        $form = $this->createForm(LocationType::class, $location);
        $form->handleRequest($request);

        $locations = $this->getDoctrine()->getRepository(Location::class)->findBy([], ['name' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $location = $form->getData();
            $this->getDoctrine()->getManager()->persist($location);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('location_new.html.twig', [
            'form' => $form->createView(),
            'locations' => $locations
        ]);
    }

    /**
     * @Route("/link/new/{gameId}", name="new_link", requirements={"gameId": "\d+"})
     * @param Request $request
     * @param int $gameId
     * @return Response
     */
    public function newLink(Request $request, int $gameId)
    {
        $link = new Link();
        $form = $this->createForm(LinkType::class, $link);
        $form->handleRequest($request);

        $links = $this->getDoctrine()->getRepository(Link::class)->findBy([], ['type' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $link = $form->getData();
            $game = $this->getDoctrine()->getManager()->getRepository(Game::class)->find($gameId);
//            $game = $this->getDoctrine()->getManager()->getReference(Game::class, $gameId);
            $link->setGame($game);
            $this->getDoctrine()->getManager()->persist($link);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('link_new.html.twig', [
            'form' => $form->createView(),
            'links' => $links
        ]);
    }

    /**
     * @Route("/competition/new", name="new_competition")
     * @param Request $request
     * @return Response
     */
    public function newCompetition(Request $request)
    {
        $competition = new Competition();
        $form = $this->createForm(CompetitionType::class, $competition);
        $form->handleRequest($request);

        $competitions = $this->getDoctrine()->getRepository(Competition::class)->findBy([], ['name' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $competition = $form->getData();
            $this->getDoctrine()->getManager()->persist($competition);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('competition_new.html.twig', [
            'form' => $form->createView(),
            'competitions' => $competitions
        ]);
    }

    /**
     * @Route("/season/new", name="new_season")
     * @param Request $request
     * @return Response
     */
    public function newSeason(Request $request)
    {
        $season = new Season();
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        $seasons = $this->getDoctrine()->getRepository(Season::class)->findBy([], ['name' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $season = $form->getData();
            $season->setId(substr($season->getName(), 0, 4));
            $this->getDoctrine()->getManager()->persist($season);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('season_new.html.twig', [
            'form' => $form->createView(),
            'seasons' => $seasons
        ]);
    }

    /**
     * @Route("/phase/new", name="new_phase")
     * @param Request $request
     * @return Response
     */
    public function newPhase(Request $request)
    {
        $phase = new Phase();
        $form = $this->createForm(PhaseType::class, $phase);
        $form->handleRequest($request);

        $phases = $this->getDoctrine()->getRepository(Phase::class)->findBy([], ['name' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $phase = $form->getData();
            $this->getDoctrine()->getManager()->persist($phase);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('phase_new.html.twig', [
            'form' => $form->createView(),
            'phases' => $phases
        ]);
    }

    /**
     * @Route("/team/new", name="new_team")
     * @param Request $request
     * @return Response
     */
    public function newTeam(Request $request)
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        $teams = $this->getDoctrine()->getRepository(Team::class)->findBy([], ['name' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $team = $form->getData();
            $this->getDoctrine()->getManager()->persist($team);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('team_new.html.twig', [
            'form' => $form->createView(),
            'teams' => $teams
        ]);
    }


    /**
     * @Route("/sport/new", name="new_sport")
     * @param Request $request
     * @return Response
     */
    public function newSport(Request $request)
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        $sports = $this->getDoctrine()->getRepository(Sport::class)->findBy([], ['name' => 'ASC']);

        if ($form->isSubmitted() && $form->isValid()) {
            $sport = $form->getData();
            $this->getDoctrine()->getManager()->persist($sport);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('sport_new.html.twig', [
            'form' => $form->createView(),
            'sports' => $sports
        ]);
    }

    /**
     * @Route("/game/new", name="new_game")
     * @param Request $request
     * @return Response
     */
    public function newGame(Request $request)
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game = $form->getData();
            $this->getDoctrine()->getManager()->persist($game);
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('game_new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}