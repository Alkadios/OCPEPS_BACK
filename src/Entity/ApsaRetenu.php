<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ApsaRetenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApsaRetenuRepository::class)
 * @ORM\Table(
 *      name="apsa_retenu",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_select_annee_id","af_retenu_id"})}
 * )
 * @UniqueEntity(
 *      fields={"ApsaSelectAnnee", "AfRetenu"},
 *      message="Apsaretenu for given country already exists in database."
 * )
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:apsaSelectAnnee','read:critere', 'read:Apsa', 'read:AfRetenu', 'read:Critere', 'read:apsaSelectAnnee','read:choixAnnee', 'read:apsaRetenu']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:ApsaRetenu']
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
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['ApsaSelectAnnee.Annee.id' => 'exact', 'ApsaSelectAnnee.etablissement.id' => 'exact', 'AfRetenu.ChoixAnnee.Niveau.id' => 'exact'])]
class ApsaRetenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:ApsaRetenu', 'read:Apsa', 'read:apsaRetenu', 'read:caId'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=AfRetenu::class, inversedBy="apsaRetenus")
     * @ORM\JoinColumn(name="af_retenu_id", referencedColumnName="id", onDelete="CASCADE")
     */
    #[Groups(['read:AfRetenu', 'post:ApsaRetenu', 'read:eleve', 'read:ApsaRetenu', 'read:apsaSelectAnnee'])]
    private $AfRetenu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:AfRetenu', 'post:ApsaRetenu', 'read:caId'])]
    private $SituationEvaluation;


    /**
     * @ORM\ManyToOne(targetEntity=ApsaSelectAnnee::class, inversedBy="apsaRetenus")
     * @ORM\JoinColumn(name="apsa_select_annee_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    #[Groups(['post:ApsaRetenu', 'read:apsaRetenu', 'read:apsaSelectAnnee', 'read:caId'])]
    private $ApsaSelectAnnee;

    /**
     * @ORM\OneToMany(targetEntity=Critere::class, mappedBy="ApsaRetenu", orphanRemoval=true)
     */
    #[Groups(['read:apsaRetenu', 'read:eleve', 'read:apsaSelectAnnee', 'read:ordreIndicateur'])]
    private $criteres;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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


    public function getSituationEvaluation(): ?string
    {
        return $this->SituationEvaluation;
    }

    public function setSituationEvaluation(string $SituationEvaluation): self
    {
        $this->SituationEvaluation = $SituationEvaluation;

        return $this;
    }


    public function getApsaSelectAnnee(): ?ApsaSelectAnnee
    {
        return $this->ApsaSelectAnnee;
    }

    public function setApsaSelectAnnee(?ApsaSelectAnnee $ApsaSelectAnnee): self
    {
        $this->ApsaSelectAnnee = $ApsaSelectAnnee;

        return $this;
    }

    /**
     * @return Collection<int, Critere>
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
