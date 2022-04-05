<?php

namespace App\Entity;

use App\Repository\EvaluationIndicateurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvaluationIndicateurRepository::class)
 * @ORM\Table(
 *      name="Evaluation_Indicateur",
 *
 * )
 */
class EvaluationIndicateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Evaluation::class, inversedBy="evaluationIndicateurs")
     */
    private $Evaluation;

    /**
     * @ORM\ManyToOne(targetEntity=Indicateur::class, inversedBy="evaluationIndicateurs")
     */
    private $Indicateur;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
