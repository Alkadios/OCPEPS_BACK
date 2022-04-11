<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvaluationEleveRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvaluationEleveRepository::class)
 * @ApiResource()
 */
class EvaluationEleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="evaluationEleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Evaluation::class, inversedBy="evaluationEleves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Evaluation;

    /**
     * @ORM\ManyToOne(targetEntity=Indicateur::class, inversedBy="evaluationEleves")
     * @ORM\JoinColumn(nullable=false)
     */
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