<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 * @ApiResource()
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:eleve'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:eleve'])]
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:eleve'])]
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailParent1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mailParent2;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaiss;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexeEleve;



    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="eleves")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=EvaluationEleve::class, mappedBy="Eleve", orphanRemoval=true)
     */
    private $evaluationEleves;

    /**
     * @ORM\ManyToMany(targetEntity=Classe::class, mappedBy="Eleve")
     */
    private $classes;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="Eleve")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
        $this->evaluationEleves = new ArrayCollection();
        $this->classes = new ArrayCollection();

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

    public function getMailParent1(): ?string
    {
        return $this->mailParent1;
    }

    public function setMailParent1(string $mailParent1): self
    {
        $this->mailParent1 = $mailParent1;

        return $this;
    }

    public function getMailParent2(): ?string
    {
        return $this->mailParent2;
    }

    public function setMailParent2(string $mailParent2): self
    {
        $this->mailParent2 = $mailParent2;

        return $this;
    }

    public function getDateNaiss(): ?\DateTimeInterface
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(\DateTimeInterface $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getSexeEleve(): ?string
    {
        return $this->sexeEleve;
    }

    public function setSexeEleve(string $sexeEleve): self
    {
        $this->sexeEleve = $sexeEleve;

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
            $evaluationElefe->setEleve($this);
        }

        return $this;
    }

    public function removeEvaluationElefe(EvaluationEleve $evaluationElefe): self
    {
        if ($this->evaluationEleves->removeElement($evaluationElefe)) {
            // set the owning side to null (unless already changed)
            if ($evaluationElefe->getEleve() === $this) {
                $evaluationElefe->setEleve(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->addEleve($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            $class->removeEleve($this);
        }

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
