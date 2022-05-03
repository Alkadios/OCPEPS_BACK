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
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:champ_apprentissage', 'read:apsaRetenu']
            ]
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:Apsa']
            ]
        ]
    ]
)]
class Apsa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:apsa', 'read:champ_apprentissage', 'read:Apsa', 'read:apsaId', 'post:apsaSelectAnnee', 'read:apsaRetenu', 'read:apsaSelectAnnee'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:apsa', 'read:champ_apprentissage', 'read:Apsa', 'read:apsaLibelle', 'post:Apsa', 'read:apsaRetenu', 'read:professeurClasse', 'read:apsaSelectAnnee'])]
    private $libelle;


    /**
     * @ORM\OneToMany(targetEntity=ChampsApprentissageApsa::class, mappedBy="Apsa")
     */
    private $champsApprentissageApsas;

    /**
     * @ORM\OneToMany(targetEntity=ApsaSelectAnnee::class, mappedBy="Apsa")
     */
    private $apsaSelectAnnees;


    public function __construct()
    {
        $this->apsaRetenus = new ArrayCollection();
        $this->champsApprentissageApsas = new ArrayCollection();
        $this->apsaSelectAnnees = new ArrayCollection();

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
     * @return Collection|ChampsApprentissageApsa[]
     */
    public function getChampsApprentissageApsas(): Collection
    {
        return $this->champsApprentissageApsas;
    }

    public function addChampsApprentissageApsa(ChampsApprentissageApsa $champsApprentissageApsa): self
    {
        if (!$this->champsApprentissageApsas->contains($champsApprentissageApsa)) {
            $this->champsApprentissageApsas[] = $champsApprentissageApsa;
            $champsApprentissageApsa->setApsa($this);
        }

        return $this;
    }

    public function removeChampsApprentissageApsa(ChampsApprentissageApsa $champsApprentissageApsa): self
    {
        if ($this->champsApprentissageApsas->removeElement($champsApprentissageApsa)) {
            // set the owning side to null (unless already changed)
            if ($champsApprentissageApsa->getApsa() === $this) {
                $champsApprentissageApsa->setApsa(null);
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
            $apsaSelectAnnee->setApsa($this);
        }

        return $this;
    }

    public function removeApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if ($this->apsaSelectAnnees->removeElement($apsaSelectAnnee)) {
            // set the owning side to null (unless already changed)
            if ($apsaSelectAnnee->getApsa() === $this) {
                $apsaSelectAnnee->setApsa(null);
            }
        }

        return $this;
    }

}
