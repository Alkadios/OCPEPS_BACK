<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
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
                'groups' => ['read:Apsa', 'read:AfRetenu', 'read:Critere']
            ]
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:ApsaRetenu']
            ]
        ]
    ]
)]
class ApsaRetenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:ApsaRetenu', 'read:Apsa'])]
    private $id;



    /**
     * @ORM\ManyToOne(targetEntity=AfRetenu::class, inversedBy="apsaRetenus")
     */
    #[Groups(['read:AfRetenu', 'post:ApsaRetenu'])]
    private $AfRetenu;



    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['post:ApsaRetenu'])]
    private $SituationEvaluation;

    /**
     * @ORM\OneToMany(targetEntity=Indicateur::class, mappedBy="ApsaRetenu")
     */
    private $indicateurs;

    /**
     * @ORM\ManyToOne(targetEntity=ApsaSelectAnnee::class, inversedBy="apsaRetenus")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['post:ApsaRetenu'])]
    private $ApsaSelectAnnee;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="ApsaRetenu")
     */
    private $evaluations;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
        $this->indicateurs = new ArrayCollection();
        $this->evaluations = new ArrayCollection();
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

    /**
     * @return Collection<int, Indicateur>
     */
    public function getIndicateurs(): Collection
    {
        return $this->indicateurs;
    }

    public function addIndicateur(Indicateur $indicateur): self
    {
        if (!$this->indicateurs->contains($indicateur)) {
            $this->indicateurs[] = $indicateur;
            $indicateur->setApsaRetenu($this);
        }

        return $this;
    }

    public function removeIndicateur(Indicateur $indicateur): self
    {
        if ($this->indicateurs->removeElement($indicateur)) {
            // set the owning side to null (unless already changed)
            if ($indicateur->getApsaRetenu() === $this) {
                $indicateur->setApsaRetenu(null);
            }
        }

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
     * @return Collection<int, Evaluation>
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setApsaRetenu($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getApsaRetenu() === $this) {
                $evaluation->setApsaRetenu(null);
            }
        }

        return $this;
    }
}
