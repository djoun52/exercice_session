<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SessionRepository::class)
 */
class Session
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
    private $intitule;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDeFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlaceTheorique;

    /**
     * @ORM\ManyToOne(targetEntity=Programme::class, inversedBy="session")
     */
    private $programme;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDateDeDebut(): ?\DateTimeInterface
    {
        return $this->dateDeDebut;
    }

    public function setDateDeDebut(\DateTimeInterface $dateDeDebut): self
    {
        $this->dateDeDebut = $dateDeDebut;

        return $this;
    }

    public function getDateDeFin(): ?\DateTimeInterface
    {
        return $this->dateDeFin;
    }

    public function setDateDeFin(\DateTimeInterface $dateDeFin): self
    {
        $this->dateDeFin = $dateDeFin;

        return $this;
    }

    public function getNbPlaceTheorique(): ?int
    {
        return $this->nbPlaceTheorique;
    }

    public function setNbPlaceTheorique(int $nbPlaceTheorique): self
    {
        $this->nbPlaceTheorique = $nbPlaceTheorique;

        return $this;
    }

    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(?Programme $programme): self
    {
        $this->programme = $programme;

        return $this;
    }
}
