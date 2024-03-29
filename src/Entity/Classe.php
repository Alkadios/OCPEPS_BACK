<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ClasseRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:classe', 'read:eleve']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:classe', 'post:eleve']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:classe', 'read:eleve']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            'normalization_context' => [
                'groups' => ['delete:classe', 'delete:eleve']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            'denormalization_context' => [
                'groups' => ['put:classe']
            ],
            'normalization_context' => [
                'groups' => ['read:classe', 'read:eleve']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['professeurs.id' => 'exact','etablissement.id' => 'exact','Annee.id' => 'exact'])]
class Classe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:professeurClasse', 'read:classe','post:classe','put:classe', 'read:eleveApsa'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:classe', 'read:professeurClasse','post:classe','put:classe', 'read:eleveApsa'])]
    private $libelleClasse;


    /**
     * @ORM\ManyToOne(targetEntity=NiveauScolaire::class, inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:classe','post:classe','put:classe', 'read:eleve'])]
    private $NiveauScolaire;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="classes")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:classe','post:classe', 'read:eleveApsa','put:classe', 'read:eleve'])]
    private $Annee;


    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="Classe", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:classe','post:classe','put:classe', 'read:eleve'])]
    private $etablissement;

    /**
     * @ORM\ManyToMany(targetEntity=Professeur::class, mappedBy="classe")
     */
    #[Groups(['read:classe','post:classe','put:classe'])]
    private $professeurs;

    /**
     * @ORM\ManyToMany(targetEntity=Eleve::class, mappedBy="classe")
     */
    #[Groups(['read:classe','post:classe','post:eleve','put:classe'])]
    private $eleves;

    /**
     * @ORM\ManyToMany(targetEntity=Eleve::class, mappedBy="classe")
     */
    #[Groups(['read:classe','post:classe','put:classe'])]
    private $professeurClasses;



    public function __construct()
    {
        $this->eleveClasses = new ArrayCollection();
        $this->professeurClasses = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
        $this->eleves = new ArrayCollection();
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
     * @return Collection<int, Professeur>
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->addClasse($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            $professeur->removeClasse($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Eleve>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addEleve(Eleve $eleve): self
    {
        if (!$this->eleves->contains($eleve)) {
            $this->eleves[] = $eleve;
            $eleve->addClasse($this);
        }

        return $this;
    }

    public function removeEleve(Eleve $eleve): self
    {
        if ($this->eleves->removeElement($eleve)) {
            $eleve->removeClasse($this);
        }

        return $this;
    }


}
