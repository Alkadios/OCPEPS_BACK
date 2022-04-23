<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:eleve']
    ]
)]
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:classe', 'read:professeurClasse'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:classe', 'read:professeurClasse'])]
    private $libelleClasse;


    /**
     * @ORM\ManyToOne(targetEntity=NiveauScolaire::class, inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NiveauScolaire;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Annee;


    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="Classe", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    /**
     * @ORM\OneToMany(targetEntity=EleveClasse::class, mappedBy="classe", orphanRemoval=true)
     */
    private $eleveClasses;

    /**
     * @ORM\OneToMany(targetEntity=ProfesseurClasse::class, mappedBy="classe", orphanRemoval=true)
     */
    private $professeurClasses;

    public function __construct()
    {
        $this->eleveClasses = new ArrayCollection();
        $this->professeurClasses = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleClasse(): ?string
    {
        return $this->libelleClasse;
    }

    public function setLibelleClasse(string $libelleClasse): self
    {
        $this->libelleClasse = $libelleClasse;

        return $this;
    }

    public function getNiveauScolaire(): ?NiveauScolaire
    {
        return $this->NiveauScolaire;
    }

    public function setNiveauScolaire(?NiveauScolaire $NiveauScolaire): self
    {
        $this->NiveauScolaire = $NiveauScolaire;

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

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection<int, EleveClasse>
     */
    public function getEleveClasses(): Collection
    {
        return $this->eleveClasses;
    }

    public function addEleveClass(EleveClasse $eleveClass): self
    {
        if (!$this->eleveClasses->contains($eleveClass)) {
            $this->eleveClasses[] = $eleveClass;
            $eleveClass->setClasse($this);
        }

        return $this;
    }

    public function removeEleveClass(EleveClasse $eleveClass): self
    {
        if ($this->eleveClasses->removeElement($eleveClass)) {
            // set the owning side to null (unless already changed)
            if ($eleveClass->getClasse() === $this) {
                $eleveClass->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProfesseurClasse>
     */
    public function getProfesseurClasses(): Collection
    {
        return $this->professeurClasses;
    }

    public function addProfesseurClass(ProfesseurClasse $professeurClass): self
    {
        if (!$this->professeurClasses->contains($professeurClass)) {
            $this->professeurClasses[] = $professeurClass;
            $professeurClass->setClasse($this);
        }

        return $this;
    }

    public function removeProfesseurClass(ProfesseurClasse $professeurClass): self
    {
        if ($this->professeurClasses->removeElement($professeurClass)) {
            // set the owning side to null (unless already changed)
            if ($professeurClass->getClasse() === $this) {
                $professeurClass->setClasse(null);
            }
        }

        return $this;
    }


}
