<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EvaluationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EvaluationRepository::class)
 * @ORM\Table(
 *      name="evaluation",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"eleve_id","date_eval"})}
 * )
 * @UniqueEntity(
 *      fields={"eleve_id","date_eval"},
 *      message="Evaluation for given country already exists in database."
 * )
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
     * @ORM\Column(type="date")
     */
    private $DateEval;

    /**
     * @ORM\ManyToOne(targetEntity=ApsaRetenu::class, inversedBy="evaluations")
     */
    private $ApsaRetenu;

    /**
     * @ORM\OneToMany(targetEntity=EvaluationIndicateur::class, mappedBy="Evaluation")
     */
    private $evaluationIndicateurs;

    public function __construct()
    {
        $this->evaluationIndicateurs = new ArrayCollection();
    }



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


    public function getDateEval(): ?\DateTimeInterface
    {
        return $this->DateEval;
    }

    public function setDateEval(\DateTimeInterface $DateEval): self
    {
        $this->DateEval = $DateEval;

        return $this;
    }

    public function getApsaRetenu(): ?ApsaRetenu
    {
        return $this->ApsaRetenu;
    }

    public function setApsaRetenu(?ApsaRetenu $ApsaRetenu): self
    {
        $this->ApsaRetenu = $ApsaRetenu;

        return $this;
    }

    /**
     * @return Collection<int, EvaluationIndicateur>
     */
    public function getEvaluationIndicateurs(): Collection
    {
        return $this->evaluationIndicateurs;
    }

    public function addEvaluationIndicateur(EvaluationIndicateur $evaluationIndicateur): self
    {
        if (!$this->evaluationIndicateurs->contains($evaluationIndicateur)) {
            $this->evaluationIndicateurs[] = $evaluationIndicateur;
            $evaluationIndicateur->setEvaluation($this);
        }

        return $this;
    }

    public function removeEvaluationIndicateur(EvaluationIndicateur $evaluationIndicateur): self
    {
        if ($this->evaluationIndicateurs->removeElement($evaluationIndicateur)) {
            // set the owning side to null (unless already changed)
            if ($evaluationIndicateur->getEvaluation() === $this) {
                $evaluationIndicateur->setEvaluation(null);
            }
        }

        return $this;
    }


}
