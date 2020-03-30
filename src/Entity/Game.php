<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Competition")
     * @ORM\JoinColumn(name="competition", referencedColumnName="id")
     */
    private $competition;

    /**
     * @ORM\ManyToOne(targetEntity="Season")
     * @ORM\JoinColumn(name="season", referencedColumnName="id")
     */
    private $season;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team1", referencedColumnName="id")
     */
    private $team1;

    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @ORM\JoinColumn(name="team2", referencedColumnName="id")
     */
    private $team2;

    /**
     * @ORM\ManyToOne(targetEntity="Phase")
     * @ORM\JoinColumn(name="phase", referencedColumnName="id")
     */
    private $phase;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $observations;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateLastSeen;

    /**
     * @ORM\Column(type="integer", nullable=false, options={"default":0})
     */
    private $timesSeen;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"min":0, "max":5})
     */
    private $funRate;

    /**
     * @ORM\Column(type="integer", nullable=true, options={"min":0, "max":5})
     */
    private $historicRate;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCompetition()
    {
        return $this->competition;
    }

    /**
     * @param mixed $competition
     * @return Game
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param mixed $season
     * @return Game
     */
    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeam1()
    {
        return $this->team1;
    }

    /**
     * @param mixed $team1
     * @return Game
     */
    public function setTeam1($team1)
    {
        $this->team1 = $team1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeam2()
    {
        return $this->team2;
    }

    /**
     * @param mixed $team2
     * @return Game
     */
    public function setTeam2($team2)
    {
        $this->team2 = $team2;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhase()
    {
        return $this->phase;
    }

    /**
     * @param mixed $phase
     * @return Game
     */
    public function setPhase($phase)
    {
        $this->phase = $phase;
        return $this;
    }

    public function getObservations(): ?string
    {
        return $this->observations;
    }

    public function setObservations(?string $observations): self
    {
        $this->observations = $observations;

        return $this;
    }

    public function getDateLastSeen(): ?\DateTimeInterface
    {
        return $this->dateLastSeen;
    }

    public function setDateLastSeen(?\DateTimeInterface $dateLastSeen): self
    {
        $this->dateLastSeen = $dateLastSeen;

        return $this;
    }

    public function getTimesSeen(): ?int
    {
        return $this->timesSeen;
    }

    public function setTimesSeen(?int $timesSeen): self
    {
        $this->timesSeen = $timesSeen;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFunRate()
    {
        return $this->funRate;
    }

    /**
     * @param mixed $funRate
     * @return Game
     */
    public function setFunRate($funRate)
    {
        $this->funRate = $funRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHistoricRate()
    {
        return $this->historicRate;
    }

    /**
     * @param mixed $historicRate
     * @return Game
     */
    public function setHistoricRate($historicRate)
    {
        $this->historicRate = $historicRate;
        return $this;
    }
}
