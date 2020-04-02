<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Competition")
     * @ORM\JoinColumn(name="competition", referencedColumnName="id")
     */
    private $competition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $teamFlagPath;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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
     * @return Team
     */
    public function setCompetition($competition)
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTeamFlagPath()
    {
        return $this->teamFlagPath;
    }

    /**
     * @param mixed $teamFlagPath
     * @return Team
     */
    public function setTeamFlagPath($teamFlagPath)
    {
        $this->teamFlagPath = $teamFlagPath;
        return $this;
    }
}
