<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AfRetenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AfRetenuRepository::class)
 * @ORM\Table(
 *      name="afretenu",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"choix_annee_id", "af_id"})}
 * )
 * @UniqueEntity(
 *      fields={"choix_annee_id","af_id"},
 *      message="Afretenu for given country already exists in database."
 * )
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:AfRetenu', 'read:Af', 'read:ApsaRetenu', 'read:Apsa'],
    ]
)]
class AfRetenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:AfRetenu'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ChoixAnnee::class, inversedBy="afRetenus")
     */
    private $ChoixAnnee;

    /**
     * @ORM\ManyToOne(targetEntity=Af::class, inversedBy="afRetenus")
     */
    #[Groups(['read:Af', 'read:AfRetenu'])]
    private $Af;

    /**
     * @ORM\OneToMany(targetEntity=ApsaRetenu::class, mappedBy="AfRetenu")
     */
    #[Groups(['read:ApsaRetenu'])]
    private $apsaRetenus;

    public function __construct()
    {
        $this->apsaRetenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getChoixAnnee(): ?ChoixAnnee
    {
        return $this->ChoixAnnee;
    }

    public function setChoixAnnee(?ChoixAnnee $ChoixAnnee): self
    {
        $this->ChoixAnnee = $ChoixAnnee;

        return $this;
    }

    public function getAf(): ?Af
    {
        return $this->Af;
    }

    public function setAf(?Af $Af): self
    {
        $this->Af = $Af;

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
            $apsaRetenu->setAfRetenu($this);
        }

        return $this;
    }

    public function removeApsaRetenu(ApsaRetenu $apsaRetenu): self
    {
        if ($this->apsaRetenus->removeElement($apsaRetenu)) {
            // set the owning side to null (unless already changed)
            if ($apsaRetenu->getAfRetenu() === $this) {
                $apsaRetenu->setAfRetenu(null);
            }
        }

        return $this;
    }
}