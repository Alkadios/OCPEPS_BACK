<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CritereRepository::class)
 * @ApiResource()
 */
class Critere
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
     * @ORM\ManyToOne(targetEntity=ApsaRetenu::class, inversedBy="criteres")
     */
    private $ApsaRetenu;

    /**
     * @ORM\OneToMany(targetEntity=IndicateurCritere::class, mappedBy="Critere")
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

    public function getApsaRetenu(): ?ApsaRetenu
    {
        return $this->ApsaRetenu;
    }

    public function setApsaRetenu(?ApsaRetenu $ApsaRetenu): self
    {
        $this->ApsaRetenu = $ApsaRetenu;

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
            $indicateurCritere->setCritere($this);
        }

        return $this;
    }

    public function removeIndicateurCritere(IndicateurCritere $indicateurCritere): self
    {
        if ($this->indicateurCriteres->removeElement($indicateurCritere)) {
            // set the owning side to null (unless already changed)
            if ($indicateurCritere->getCritere() === $this) {
                $indicateurCritere->setCritere(null);
            }
        }

        return $this;
    }
}
