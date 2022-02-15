<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CaRepository::class)
 * @ApiResource()
 */
class Ca
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
     * @ORM\OneToMany(targetEntity=Apsa::class, mappedBy="ca")
     */
    private $Apsa;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="Ca")
     */
    private $choixAnnees;

    public function __construct()
    {
        $this->Apsa = new ArrayCollection();
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

    /**
     * @return Collection|Apsa[]
     */
    public function getApsa(): Collection
    {
        return $this->Apsa;
    }

    public function addApsa(Apsa $apsa): self
    {
        if (!$this->Apsa->contains($apsa)) {
            $this->Apsa[] = $apsa;
            $apsa->setCa($this);
        }

        return $this;
    }

    public function removeApsa(Apsa $apsa): self
    {
        if ($this->Apsa->removeElement($apsa)) {
            // set the owning side to null (unless already changed)
            if ($apsa->getCa() === $this) {
                $apsa->setCa(null);
            }
        }

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
            $choixAnnee->setCa($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->choixAnnees->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getCa() === $this) {
                $choixAnnee->setCa(null);
            }
        }

        return $this;
    }
}
