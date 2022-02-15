<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IndicateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IndicateurRepository::class)
 * @ApiResource()
 */
class Indicateur
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=IndicateurCritere::class, mappedBy="Indicateur")
     */
    private $indicateurCriteres;

    public function __construct()
    {
        $this->indicateurCriteres = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|IndicateurCritere[]
     */
    public function getIndicateurCriteres(): Collection
    {
        return $this->indicateurCriteres;
    }

    public function addIndicateurCritere(IndicateurCritere $indicateurCritere): self
    {
        if (!$this->indicateurCriteres->contains($indicateurCritere)) {
            $this->indicateurCriteres[] = $indicateurCritere;
            $indicateurCritere->setIndicateur($this);
        }

        return $this;
    }

    public function removeIndicateurCritere(IndicateurCritere $indicateurCritere): self
    {
        if ($this->indicateurCriteres->removeElement($indicateurCritere)) {
            // set the owning side to null (unless already changed)
            if ($indicateurCritere->getIndicateur() === $this) {
                $indicateurCritere->setIndicateur(null);
            }
        }

        return $this;
    }
}
