<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProfesseurRepository::class)
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:professeur']
    ]
)]

#[ApiFilter(SearchFilter::class, properties: ['etablissements' => 'exact'])]
class Professeur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:professeur','read:classe'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:professeur'])]
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:professeur'])]
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:professeur'])]
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="Professeur")
     */
    #[Groups(['read:professeur'])]
    private $cours;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="professeurs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */

    #[Groups(['read:professeur'])]
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Etablissement::class, mappedBy="Professeur")
     */
    #[Groups(['read:professeur'])]
    private $etablissements;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, inversedBy="professeurs")
     */
    #[Groups(['read:professeur'])]
    private $classe;


    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->etablissements = new ArrayCollection();
        $this->professeurClasses = new ArrayCollection();
        $this->classe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissements(): Collection
    {
        return $this->etablissements;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissements->contains($etablissement)) {
            $this->etablissements[] = $etablissement;
            $etablissement->addProfesseur($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissements->removeElement($etablissement)) {
            $etablissement->removeProfesseur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->classe->contains($classe)) {
            $this->classe[] = $classe;
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        $this->classe->removeElement($classe);

        return $this;
    }



}
