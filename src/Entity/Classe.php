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
    #[Groups(['read:classe'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:classe'])]
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
     * @ORM\ManyToMany(targetEntity=Eleve::class, inversedBy="classes")
     */
    private $Eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="Classe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;



    public function __construct()
    {
        $this->Eleve = new ArrayCollection();
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

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleve(): Collection
    {
        return $this->Eleve;
    }

    public function addEleve(Eleve $eleve): self
    {
        if (!$this->Eleve->contains($eleve)) {
            $this->Eleve[] = $eleve;
        }

        return $this;
    }

    public function removeEleve(Eleve $eleve): self
    {
        $this->Eleve->removeElement($eleve);

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


}
