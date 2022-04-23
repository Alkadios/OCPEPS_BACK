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
 *      name="evaluation"
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
     * @ORM\Column(type="date")
     */
    private $DateEval;

    /**
     * @ORM\OneToMany(targetEntity=EvaluationEleve::class, mappedBy="Evaluation", orphanRemoval=true)
     */
    private $evaluationEleves;

    public function __construct()
    {
        $this->evaluationEleves = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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
            $evaluationElefe->setEvaluation($this);
        }

        return $this;
    }

    public function removeEvaluationElefe(EvaluationEleve $evaluationElefe): self
    {
        if ($this->evaluationEleves->removeElement($evaluationElefe)) {
            // set the owning side to null (unless already changed)
            if ($evaluationElefe->getEvaluation() === $this) {
                $evaluationElefe->setEvaluation(null);
            }
        }

        return $this;
    }


}
