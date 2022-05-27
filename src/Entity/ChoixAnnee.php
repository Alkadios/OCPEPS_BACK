<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ChoixAnneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChoixAnneeRepository::class)
 * @ORM\Table(
 *      name="choix_annee",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"niveau_id", "annee_id","champ_apprentissage_id"})}
 * )
 * @UniqueEntity(
 *      fields={"Niveau","Annee","champApprentissage"},
 *      message="ChoixAnnee for given country already exists in database."
 * )
 * @ApiResource()
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:choixAnnee']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
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
#[ApiFilter(SearchFilter::class, properties: ['etablissement.id' => 'exact', 'Annee.id' => 'exact'])]
class ChoixAnnee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:choixAnnee', 'read:caId',  'read:AfRetenu',  'read:ApsaRetenu'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauScolaire::class, inversedBy="choixAnnees")
     */
    #[Groups(['read:choixAnnee', 'read:AfRetenu', 'read:caId', 'read:eleve', 'read:ApsaRetenu', 'read:apsaSelectAnnee'])]
    private $Niveau;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="choixAnnees")
     */
    #[Groups(['read:choixAnnee', 'read:eleve'])]
    private $Annee;


    /**
     * @ORM\OneToMany(targetEntity=AfRetenu::class, mappedBy="ChoixAnnee")
     */
    #[Groups(['read:choixAnnee'])]
    private $afRetenus;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="ChoixAnnee")
     */
    #[Groups(['read:ca','read:choixAnnee'])]
    private $champApprentissage;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="choixAnnee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    public function __construct()
    {
        $this->afRetenus = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?NiveauScolaire
    {
        return $this->Niveau;
    }

    public function setNiveau(?NiveauScolaire $Niveau): self
    {
        $this->Niveau = $Niveau;

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
     * @return Collection|AfRetenu[]
     */
    public function getAfRetenus(): Collection
    {
        return $this->afRetenus;
    }

    public function addAfRetenu(AfRetenu $afRetenu): self
    {
        if (!$this->afRetenus->contains($afRetenu)) {
            $this->afRetenus[] = $afRetenu;
            $afRetenu->setChoixAnnee($this);
        }

        return $this;
    }

    public function removeAfRetenu(AfRetenu $afRetenu): self
    {
        if ($this->afRetenus->removeElement($afRetenu)) {
            // set the owning side to null (unless already changed)
            if ($afRetenu->getChoixAnnee() === $this) {
                $afRetenu->setChoixAnnee(null);
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