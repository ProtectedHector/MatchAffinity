<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompetitionRepository")
 */
class Competition
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
     * @ORM\ManyToOne(targetEntity="Location")
     * @ORM\JoinColumn(name="location", referencedColumnName="id")
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Sport")
     * @ORM\JoinColumn(name="sport", referencedColumnName="id")
     */
    private $sport;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":"1"})
     */
    private $multianual;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Competition
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSport()
    {
        return $this->sport;
    }

    /**
     * @param mixed $sport
     * @return Competition
     */
    public function setSport($sport)
    {
        $this->sport = $sport;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMultianual()
    {
        return $this->multianual;
    }

    /**
     * @param mixed $multianual
     * @return Competition
     */
    public function setMultianual($multianual)
    {
        $this->multianual = $multianual;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIconKeyword()
    {
        return $this->iconKeyword;
    }

    /**
     * @param mixed $iconKeyword
     * @return Competition
     */
    public function setIconKeyword($iconKeyword)
    {
        $this->iconKeyword = $iconKeyword;
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
     * @return Competition
     */
    public function setFlagPath($flagPath)
    {
        $this->flagPath = $flagPath;
        return $this;
    }
}
