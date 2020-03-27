<?php


namespace App\Controller;


use App\Entity\Location;
use App\Entity\Game;
use App\Entity\User;
use App\Form\LocationType;
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
        $games = $this->getDoctrine()->getRepository(Game::class)->findAll();

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
}