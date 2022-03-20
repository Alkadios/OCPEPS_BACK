<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnneeRepository::class)
 */
#[ApiResource()]
class Annee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $anne;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="Annee")
     */
    private $choixAnnees;

    /**
     * @ORM\OneToMany(targetEntity=ApsaSelectAnnee::class, mappedBy="Annee")
     */
    private $apsaSelectAnnees;

    public function __construct()
    {
        $this->choixAnnees = new ArrayCollection();
        $this->apsaSelectAnnees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnne(): ?\DateTimeInterface
    {
        return $this->anne;
    }

    public function setAnne(\DateTimeInterface $anne): self
    {
        $this->anne = $anne;

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
            $choixAnnee->setAnnee($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->choixAnnees->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getAnnee() === $this) {
                $choixAnnee->setAnnee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ApsaSelectAnnee[]
     */
    public function getApsaSelectAnnees(): Collection
    {
        return $this->apsaSelectAnnees;
    }

    public function addApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if (!$this->apsaSelectAnnees->contains($apsaSelectAnnee)) {
            $this->apsaSelectAnnees[] = $apsaSelectAnnee;
            $apsaSelectAnnee->setAnnee($this);
        }

        return $this;
    }

    public function removeApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if ($this->apsaSelectAnnees->removeElement($apsaSelectAnnee)) {
            // set the owning side to null (unless already changed)
            if ($apsaSelectAnnee->getAnnee() === $this) {
                $apsaSelectAnnee->setAnnee(null);
            }
        }

        return $this;
    }
}
