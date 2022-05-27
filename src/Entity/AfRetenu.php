<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\AfRetenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AfRetenuRepository::class)
 * @ORM\Table(
 *      name="af_retenu",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"choix_annee_id", "af_id"})}
 * )
 * @UniqueEntity(
 *      fields={"ChoixAnnee","Af"},
 *      message="Afretenu for given country already exists in database."
 * )
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:AfRetenu', 'read:Af', 'read:ApsaRetenu', 'read:Apsa', 'read:ca']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['ChoixAnnee.Niveau.id' => 'exact', 'ChoixAnnee.Annee.id' => 'exact'])]
class AfRetenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:AfRetenu', 'read:choixAnnee'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ChoixAnnee::class, inversedBy="afRetenus")
     */
    #[Groups(['read:ca', 'read:AfRetenu', 'read:eleve', 'read:ApsaRetenu', 'read:apsaSelectAnnee'])]
    private $ChoixAnnee;

    /**
     * @ORM\ManyToOne(targetEntity=Af::class, inversedBy="afRetenus")
     */
    #[Groups(['read:Af', 'read:AfRetenu','read:choixAnnee'])]
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