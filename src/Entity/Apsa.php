<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApsaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApsaRepository::class)
 * @ApiResource()
 */
class Apsa
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
     * @ORM\ManyToOne(targetEntity=Ca::class, inversedBy="Apsa")
     */
    private $ca;

    /**
     * @ORM\OneToMany(targetEntity=ApsaRetenu::class, mappedBy="Apsa")
     */
    private $apsaRetenus;

    public function __construct()
    {
        $this->apsaRetenus = new ArrayCollection();
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

    public function getCa(): ?Ca
    {
        return $this->ca;
    }

    public function setCa(?Ca $ca): self
    {
        $this->ca = $ca;

        return $this;
    }

    /**
     * @return Collection|ApsaRetenu[]
     */
    public function getApsaRetenus(): Collection
    {
        return $this->apsaRetenus;
    }

    public function addApsaRetenu(ApsaRetenu $apsaRetenu): self
    {
        if (!$this->apsaRetenus->contains($apsaRetenu)) {
            $this->apsaRetenus[] = $apsaRetenu;
            $apsaRetenu->setApsa($this);
        }

        return $this;
    }

    public function removeApsaRetenu(ApsaRetenu $apsaRetenu): self
    {
        if ($this->apsaRetenus->removeElement($apsaRetenu)) {
            // set the owning side to null (unless already changed)
            if ($apsaRetenu->getApsa() === $this) {
                $apsaRetenu->setApsa(null);
            }
        }

        return $this;
    }
}
