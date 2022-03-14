<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IndicateurCritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=IndicateurCritereRepository::class)
 * @ORM\Table(
 *      name="indicateurcritere",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"critere_id", "indicateur_id"})}
 * )
 * @UniqueEntity(
 *      fields={"critere_id","indicateur_id"},
 *      message="IndicateurCritere for given country already exists in database."
 * )
 * @ApiResource()
 */
class IndicateurCritere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Critere::class, inversedBy="indicateurCriteres")
     */
    private $Critere;

    /**
     * @ORM\ManyToOne(targetEntity=Indicateur::class, inversedBy="indicateurCriteres")
     */
    #[Groups(['read:indicateurCritere'])]
    private $Indicateur;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="IndicateurCritere")
     */
    private $evaluations;

    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCritere(): ?Critere
    {
        return $this->Critere;
    }

    public function setCritere(?Critere $Critere): self
    {
        $this->Critere = $Critere;

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

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setIndicateurCritere($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getIndicateurCritere() === $this) {
                $evaluation->setIndicateurCritere(null);
            }
        }

        return $this;
    }
}
