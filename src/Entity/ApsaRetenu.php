<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApsaRetenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApsaRetenuRepository::class)
 * @ORM\Table(
 *      name="apsaretenu",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "af_retenu_id"})}
 * )
 * @UniqueEntity(
 *      fields={"apsa_id","af_retenu_id"},
 *      message="Apsaretenu for given country already exists in database."
 * )
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:Apsa', 'read:AfRetenu', 'read:Critere']
    ]
)]
class ApsaRetenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:ApsaRetenu', 'read:Apsa'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Apsa::class, inversedBy="apsaRetenus")
     */
    #[Groups(['read:ApsaRetenu', 'read:Apsa'])]
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=AfRetenu::class, inversedBy="apsaRetenus")
     */
    #[Groups(['read:AfRetenu'])]
    private $AfRetenu;

    /**
     * @ORM\OneToMany(targetEntity=Critere::class, mappedBy="ApsaRetenu")
     */
    #[Groups(['read:Critere'])]
    private $criteres;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApsa(): ?Apsa
    {
        return $this->Apsa;
    }

    public function setApsa(?Apsa $Apsa): self
    {
        $this->Apsa = $Apsa;

        return $this;
    }

    public function getAfRetenu(): ?AfRetenu
    {
        return $this->AfRetenu;
    }

    public function setAfRetenu(?AfRetenu $AfRetenu): self
    {
        $this->AfRetenu = $AfRetenu;

        return $this;
    }

    /**
     * @return Collection|Critere[]
     */
    public function getCriteres(): Collection
    {
        return $this->criteres;
    }

    public function addCritere(Critere $critere): self
    {
        if (!$this->criteres->contains($critere)) {
            $this->criteres[] = $critere;
            $critere->setApsaRetenu($this);
        }

        return $this;
    }

    public function removeCritere(Critere $critere): self
    {
        if ($this->criteres->removeElement($critere)) {
            // set the owning side to null (unless already changed)
            if ($critere->getApsaRetenu() === $this) {
                $critere->setApsaRetenu(null);
            }
        }

        return $this;
    }
}
