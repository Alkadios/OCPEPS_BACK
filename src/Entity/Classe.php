<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 * @ApiResource()
 */
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleClasse;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="classe")
     */
    private $Eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Cycle::class, inversedBy="classes")
     */
    private $cycle;

    public function __construct()
    {
        $this->Eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleClasse(): ?string
    {
        return $this->libelleClasse;
    }

    public function setLibelleClasse(string $libelleClasse): self
    {
        $this->libelleClasse = $libelleClasse;

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleve(): Collection
    {
        return $this->Eleve;
    }

    public function addEleve(Eleve $eleve): self
    {
        if (!$this->Eleve->contains($eleve)) {
            $this->Eleve[] = $eleve;
            $eleve->setClasse($this);
        }

        return $this;
    }

    public function removeEleve(Eleve $eleve): self
    {
        if ($this->Eleve->removeElement($eleve)) {
            // set the owning side to null (unless already changed)
            if ($eleve->getClasse() === $this) {
                $eleve->setClasse(null);
            }
        }

        return $this;
    }

    public function getCycle(): ?Cycle
    {
        return $this->cycle;
    }

    public function setCycle(?Cycle $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }
}
