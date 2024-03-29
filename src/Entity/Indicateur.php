<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\IndicateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IndicateurRepository::class)
 * @ApiResource()
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:indicateur', 'read:critere']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ]
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['critere.id' => 'exact'])]
class Indicateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:indicateur', 'read:critere', 'read:apsaSelectAnnee', 'read:apsaRetenu'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:indicateur', 'read:critere', 'read:apsaSelectAnnee'])]
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:indicateur', 'read:critere', 'read:apsaSelectAnnee'])]
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=EvaluationEleve::class, mappedBy="Indicateur", orphanRemoval=true)
     */
    #[Groups(['read:indicateur', 'read:critere', 'read:apsaSelectAnnee'])]
    private $evaluationEleves;

    /**
     * @ORM\ManyToOne(targetEntity=Critere::class, inversedBy="Indicateur")
     * @ORM\JoinColumn(name="critere_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    private $critere;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(['read:indicateur', 'read:apsaSelectAnnee'])]
    private $url_video;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(['read:indicateur', 'read:apsaSelectAnnee'])]
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(['read:indicateur', 'read:critere', 'read:apsaSelectAnnee', 'read:ordreIndicateur'])]
    private $ordre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:indicateur','read:critere', 'read:apsaSelectAnnee'])]
    private $color;

    public function __construct()
    {
        $this->evaluationEleves = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, EvaluationEleve>
     */
    public function getEvaluationEleves(): Collection
    {
        return $this->evaluationEleves;
    }

    public function addEvaluationElefe(EvaluationEleve $evaluationElefe): self
    {
        if (!$this->evaluationEleves->contains($evaluationElefe)) {
            $this->evaluationEleves[] = $evaluationElefe;
            $evaluationElefe->setIndicateur($this);
        }

        return $this;
    }

    public function removeEvaluationElefe(EvaluationEleve $evaluationElefe): self
    {
        if ($this->evaluationEleves->removeElement($evaluationElefe)) {
            // set the owning side to null (unless already changed)
            if ($evaluationElefe->getIndicateur() === $this) {
                $evaluationElefe->setIndicateur(null);
            }
        }

        return $this;
    }

    public function getCritere(): ?Critere
    {
        return $this->critere;
    }

    public function setCritere(?Critere $critere): self
    {
        $this->critere = $critere;

        return $this;
    }

    public function getUrlVideo(): ?string
    {
        return $this->url_video;
    }

    public function setUrlVideo(?string $url_video): self
    {
        $this->url_video = $url_video;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }
    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setOrdre(?int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }


    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }


}
