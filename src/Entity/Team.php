<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 * @ORM\Table(name="team", uniqueConstraints={@UniqueConstraint(name="team_idx", columns={"name", "competition"})})
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
    private $flagPath;

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
    public function getFlagPath()
    {
        return $this->flagPath;
    }

    /**
     * @param mixed $flagPath
     * @return Team
     */
    public function setFlagPath($flagPath)
    {
        $this->flagPath = $flagPath;
        return $this;
    }
}
