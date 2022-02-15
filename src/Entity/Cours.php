<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 * @ApiResource()
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $heureDebut;

    /**
     * @ORM\Column(type="time")
     */
    private $heureFin;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="cours")
     */
    private $Professeur;

    /**
     * @ORM\ManyToOne(targetEntity=InstallationSportive::class, inversedBy="Cours")
     */
    private $installationSportive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->Professeur;
    }

    public function setProfesseur(?Professeur $Professeur): self
    {
        $this->Professeur = $Professeur;

        return $this;
    }

    public function getInstallationSportive(): ?InstallationSportive
    {
        return $this->installationSportive;
    }

    public function setInstallationSportive(?InstallationSportive $installationSportive): self
    {
        $this->installationSportive = $installationSportive;

        return $this;
    }
}
