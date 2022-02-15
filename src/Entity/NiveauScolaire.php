<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NiveauScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauScolaireRepository::class)
 * @ApiResource()
 */
class NiveauScolaire
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
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Cycle::class, inversedBy="niveauScolaires")
     */
    private $cycle;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="Niveau")
     */
    private $choixAnnees;

    public function __construct()
    {
        $this->choixAnnees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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

    /**
     * @return Collection|ChoixAnnee[]
     */
    public function getChoixAnnees(): Collection
    {
        return $this->choixAnnees;
    }

    public function addChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if (!$this->choixAnnees->contains($choixAnnee)) {
            $this->choixAnnees[] = $choixAnnee;
            $choixAnnee->setNiveau($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->choixAnnees->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getNiveau() === $this) {
                $choixAnnee->setNiveau(null);
            }
        }

        return $this;
    }
}
