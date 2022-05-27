<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ApsaSelectAnneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApsaSelectAnneeRepository::class)
 * @ORM\Table(
 *      name="apsa_select_annee",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "ca_id" ,"annee_id"})}
 * )
 * @UniqueEntity(
 *      fields={"Apsa", "Ca" , "Annee"},
 *      message="ApsaSelectAnneeController for given country already exists in database."
 * )
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:apsaSelectAnnee', 'read:caId', 'read:apsaId', 'read:apsaLibelle', 'read:ordreIndicateur']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:apsaSelectAnnee']
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
#[ApiFilter(SearchFilter::class, properties: ['Annee.id' => 'exact', 'etablissement.id' => 'exact', 'Apsa.id' => 'exact'])]
class ApsaSelectAnnee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['post:ApsaRetenu', 'read:apsaSelectAnnee', 'read:eleveApsa'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="apsaSelectAnnees")
     */
    #[Groups(['read:caId', 'write:caId', 'post:apsaSelectAnnee', 'read:eleveApsa'])]
    private $Ca;

    /**
     * @ORM\ManyToOne(targetEntity=Apsa::class, inversedBy="apsaSelectAnnees")
     */
    #[Groups(['read:apsaSelectAnnee', 'write:apsaId', 'post:apsaSelectAnnee', 'read:apsaRetenu', 'read:apsaSelectAnnee', 'read:eleveApsa'])]
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="apsaSelectAnnees")
     */
    #[Groups(['read:Annee', 'write:Annee', 'post:apsaSelectAnnee', 'read:ApsaSelectAnnee', 'read:caId'])]
    private $Annee;

    /**
     * @ORM\OneToMany(targetEntity=ApsaRetenu::class, mappedBy="ApsaSelectAnnee")
     */
    #[Groups(['read:caId', 'read:eleve', 'read:apsaSelectAnnee', 'read:ordreIndicateur'])]
    private $apsaRetenus;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="ApsaSelectAnnee")
     */
    #[Groups(['read:caId', 'post:apsaSelectAnnee'])]
    private $etablissement;

    public function __construct()
    {
        $this->apsaRetenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCa(): ?ChampApprentissage
    {
        return $this->Ca;
    }

    public function setCa(?ChampApprentissage $Ca): self
    {
        $this->Ca = $Ca;

        return $this;
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

    public function getAnnee(): ?Annee
    {
        return $this->Annee;
    }

    public function setAnnee(?Annee $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }

    /**
     * @return Collection<int, ApsaRetenu>
     */
    public function getApsaRetenus(): Collection
    {
        return $this->apsaRetenus;
    }

    public function addApsaRetenu(ApsaRetenu $apsaRetenu): self
    {
        if (!$this->apsaRetenus->contains($apsaRetenu)) {
            $this->apsaRetenus[] = $apsaRetenu;
            $apsaRetenu->setApsaSelectAnnee($this);
        }

        return $this;
    }

    public function removeApsaRetenu(ApsaRetenu $apsaRetenu): self
    {
        if ($this->apsaRetenus->removeElement($apsaRetenu)) {
            // set the owning side to null (unless already changed)
            if ($apsaRetenu->getApsaSelectAnnee() === $this) {
                $apsaRetenu->setApsaSelectAnnee(null);
            }
        }

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }
}
