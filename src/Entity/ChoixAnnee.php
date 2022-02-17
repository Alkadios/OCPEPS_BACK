<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChoixAnneeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChoixAnneeRepository::class)
 * @ORM\Table(
 *      name="choixannee",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"niveau_id", "annee_id","champ_apprentissage_id"})}
 * )
 * @UniqueEntity(
 *      fields={"niveau_id","annee_id","champ_apprentissage_id"},
 *      message="ChoixAnnee for given country already exists in database."
 * )
 * @ApiResource()
 */
class ChoixAnnee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=NiveauScolaire::class, inversedBy="choixAnnees")
     */
    private $Niveau;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="choixAnnees")
     */
    private $Annee;


    /**
     * @ORM\OneToMany(targetEntity=AfRetenu::class, mappedBy="ChoixAnnee")
     */
    private $afRetenus;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="ChoixAnnee")
     */
    private $champApprentissage;

    public function __construct()
    {
        $this->afRetenus = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?NiveauScolaire
    {
        return $this->Niveau;
    }

    public function setNiveau(?NiveauScolaire $Niveau): self
    {
        $this->Niveau = $Niveau;

        return $this;
    }

    public function getAnnee(): ?Annee
    {
        return $this->Annee;
    }

    public function setAnnee(?Annee $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }




    /**
     * @return Collection|AfRetenu[]
     */
    public function getAfRetenus(): Collection
    {
        return $this->afRetenus;
    }

    public function addAfRetenu(AfRetenu $afRetenu): self
    {
        if (!$this->afRetenus->contains($afRetenu)) {
            $this->afRetenus[] = $afRetenu;
            $afRetenu->setChoixAnnee($this);
        }

        return $this;
    }

    public function removeAfRetenu(AfRetenu $afRetenu): self
    {
        if ($this->afRetenus->removeElement($afRetenu)) {
            // set the owning side to null (unless already changed)
            if ($afRetenu->getChoixAnnee() === $this) {
                $afRetenu->setChoixAnnee(null);
            }
        }

        return $this;
    }

    public function getChampApprentissage(): ?ChampApprentissage
    {
        return $this->champApprentissage;
    }

    public function setChampApprentissage(?ChampApprentissage $champApprentissage): self
    {
        $this->champApprentissage = $champApprentissage;

        return $this;
    }


}