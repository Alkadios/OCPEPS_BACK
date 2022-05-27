<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ApsaChampApprentissageController;
use App\Repository\ChampApprentissageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChampApprentissageRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'getApsa' => [
            'method' => 'GET',
            'path' => '/getApsa',
            'controller' => ApsaChampApprentissageController::class,
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'summary' => 'Get les APSA de ChampApprentissage',
                'security' => [['bearerAuth' => []]]
            ]
        ],
        'get' => [
            'normalization_context' => [
                'groups' => ['read:apsa', 'read:champapprentissage']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['psot:ChampApprentissage']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ],
)]
class ChampApprentissage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:apsa', 'read:champapprentissage', 'read:ca', 'read:caId', 'post:apsaSelectAnnee', 'read:choixAnnee', 'read:apsaRetenu'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:apsa', 'read:champapprentissage', 'psot:ChampApprentissage', 'read:choixAnnee', 'read:apsaRetenu'])]
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="champApprentissage")
     */
    private $ChoixAnnee;


    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:apsa', 'read:champapprentissage', 'psot:ChampApprentissage', 'read:apsaRetenu'])]
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=ChampsApprentissageApsa::class, mappedBy="ChampApprentissage")
     */
    #[Groups(['read:champapprentissage'])]
    private $champsApprentissageApsas;

    /**
     * @ORM\OneToMany(targetEntity=ApsaSelectAnnee::class, mappedBy="Ca")
     */
    private $apsaSelectAnnees;

    /**
     * @ORM\OneToMany(targetEntity=Af::class, mappedBy="ca")
     */
    private $afs;


    public function __construct()
    {
        $this->ChoixAnnee = new ArrayCollection();
        $this->Apsa = new ArrayCollection();
        $this->apsas = new ArrayCollection();
        $this->champsApprentissageApsas = new ArrayCollection();
        $this->apsaSelectAnnees = new ArrayCollection();
        $this->afs = new ArrayCollection();
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
     * @return Collection|ChoixAnnee[]
     */
    public function getChoixAnnee(): Collection
    {
        return $this->ChoixAnnee;
    }

    public function addChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if (!$this->ChoixAnnee->contains($choixAnnee)) {
            $this->ChoixAnnee[] = $choixAnnee;
            $choixAnnee->setChampApprentissage($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->ChoixAnnee->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getChampApprentissage() === $this) {
                $choixAnnee->setChampApprentissage(null);
            }
        }

        return $this;
    }


    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

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
            $champsApprentissageApsa->setChampApprentissage($this);
        }

        return $this;
    }

    public function removeChampsApprentissageApsa(ChampsApprentissageApsa $champsApprentissageApsa): self
    {
        if ($this->champsApprentissageApsas->removeElement($champsApprentissageApsa)) {
            // set the owning side to null (unless already changed)
            if ($champsApprentissageApsa->getChampApprentissage() === $this) {
                $champsApprentissageApsa->setChampApprentissage(null);
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
            $apsaSelectAnnee->setCa($this);
        }

        return $this;
    }

    public function removeApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if ($this->apsaSelectAnnees->removeElement($apsaSelectAnnee)) {
            // set the owning side to null (unless already changed)
            if ($apsaSelectAnnee->getCa() === $this) {
                $apsaSelectAnnee->setCa(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Af>
     */
    public function getAfs(): Collection
    {
        return $this->afs;
    }

    public function addAf(Af $af): self
    {
        if (!$this->afs->contains($af)) {
            $this->afs[] = $af;
            $af->setCa($this);
        }

        return $this;
    }

    public function removeAf(Af $af): self
    {
        if ($this->afs->removeElement($af)) {
            // set the owning side to null (unless already changed)
            if ($af->getCa() === $this) {
                $af->setCa(null);
            }
        }

        return $this;
    }

}
