<?php

namespace App\Entity;

use App\Entity\Session;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProgrammeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ProgrammeRepository::class)
 */
class Programme
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJour;

    /**
     * @ORM\ManyToOne(targetEntity=Modules::class, inversedBy="programmes")
     */
    private $module;

    /**
     * @ORM\ManyToOne(targetEntity=Session::class, inversedBy="programmes")
     */
    private $session;

    /**
     * @ORM\ManyToOne(targetEntity=Modules::class, inversedBy="programme")
     */
 

    public function __construct()
    {
        $this->module = new ArrayCollection();
        $this->session = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJour(): ?int
    {
        return $this->nbJour;
    }

    public function setNbJour(int $nbJour): self
    {
        $this->nbJour = $nbJour;

        return $this;
    }

    public function getModule(): ?Modules
    {
        return $this->module;
    }

    public function setModule(?Modules $module): self
    {
        $this->module = $module;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }


}
