<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApsaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApsaRepository::class)
 * @ApiResource()
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:champ_apprentissage'],
    ]
)]
class Apsa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:apsa', 'read:champ_apprentissage', 'read:Apsa'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:apsa', 'read:champ_apprentissage', 'read:Apsa'])]
    private $libelle;


    /**
     * @ORM\OneToMany(targetEntity=ApsaRetenu::class, mappedBy="Apsa")
     */
    private $apsaRetenus;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="Apsa")
     */
    private $champApprentissage;

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

    public function getChampApprentissage(): ?ChampApprentissage
    {
        return $this->champApprentissage;
    }

    public function setChampApprentissage(?ChampApprentissage $champApprentissage): self
    {
        $this->champApprentissage = $champApprentissage;

        return $this;
    }
}
