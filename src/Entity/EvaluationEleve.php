<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvaluationEleveRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EvaluationEleveRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:indicateur', 'read:critere', 'read:apsaRetenu']
            ],
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ]
        ]
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ]
)]
class EvaluationEleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:indicateur', 'read:apsaRetenu', 'read:apsaSelectAnnee'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="evaluationEleves")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:indicateur', 'read:apsaRetenu', 'read:apsaSelectAnnee'])]
    private $Eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Evaluation::class, inversedBy="evaluationEleves")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:indicateur', 'read:apsaRetenu', 'read:apsaSelectAnnee'])]
    private $Evaluation;

    /**
     * @ORM\ManyToOne(targetEntity=Indicateur::class, inversedBy="evaluationEleves")
     * @ORM\JoinColumn(name="indicateur_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    #[Groups(['read:indicateur', 'read:apsaRetenu', 'read:apsaSelectAnnee'])]
    private $Indicateur;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $auto_eval;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEleve(): ?Eleve
    {
        return $this->Eleve;
    }

    public function setEleve(?Eleve $Eleve): self
    {
        $this->Eleve = $Eleve;

        return $this;
    }

    public function getEvaluation(): ?Evaluation
    {
        return $this->Evaluation;
    }

    public function setEvaluation(?Evaluation $Evaluation): self
    {
        $this->Evaluation = $Evaluation;

        return $this;
    }

    public function getIndicateur(): ?Indicateur
    {
        return $this->Indicateur;
    }

    public function setIndicateur(?Indicateur $Indicateur): self
    {
        $this->Indicateur = $Indicateur;

        return $this;
    }

    public function getAutoEval(): ?bool
    {
        return $this->auto_eval;
    }

    public function setAutoEval(?bool $auto_eval): self
    {
        $this->auto_eval = $auto_eval;

        return $this;
    }
}
