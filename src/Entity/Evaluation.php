<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvaluationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvaluationRepository::class)
 * @ApiResource()
 */
class Evaluation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="evaluations")
     */
    private $ELeve;

    /**
     * @ORM\ManyToOne(targetEntity=IndicateurCritere::class, inversedBy="evaluations")
     */
    private $IndicateurCritere;

    /**
     * @ORM\Column(type="date")
     */
    private $DateEval;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getELeve(): ?Eleve
    {
        return $this->ELeve;
    }

    public function setELeve(?Eleve $ELeve): self
    {
        $this->ELeve = $ELeve;

        return $this;
    }

    public function getIndicateurCritere(): ?IndicateurCritere
    {
        return $this->IndicateurCritere;
    }

    public function setIndicateurCritere(?IndicateurCritere $IndicateurCritere): self
    {
        $this->IndicateurCritere = $IndicateurCritere;

        return $this;
    }

    public function getDateEval(): ?\DateTimeInterface
    {
        return $this->DateEval;
    }

    public function setDateEval(\DateTimeInterface $DateEval): self
    {
        $this->DateEval = $DateEval;

        return $this;
    }
}
