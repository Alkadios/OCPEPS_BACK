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
 *      name="apsaretenu",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "af_retenu_id"})}
 * )
 * @UniqueEntity(
 *      fields={"apsa_id","af_retenu_id"},
 *      message="Apsaretenu for given country already exists in database."
 * )
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:Apsa', 'read:AfRetenu', 'read:Critere']
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
     * @ORM\ManyToOne(targetEntity=Apsa::class, inversedBy="apsaRetenus")
     */
    #[Groups(['read:ApsaRetenu', 'read:Apsa'])]
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=AfRetenu::class, inversedBy="apsaRetenus")
     */
    #[Groups(['read:AfRetenu'])]
    private $AfRetenu;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SituationEvaluation;

    /**
     * @ORM\OneToMany(targetEntity=Indicateur::class, mappedBy="ApsaRetenu")
     */
    private $indicateurs;

    public function __construct()
    {
        $this->criteres = new ArrayCollection();
        $this->indicateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApsa(): ?Apsa
    {
        return $this->Apsa;
    }

    public function setApsa(?Apsa $Apsa): self
    {
        $this->Apsa = $Apsa;

        return $this;
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
}
