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
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="eleves")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="Eleve")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity=EvaluationIndicateur::class, mappedBy="Eleve")
     */
    private $evaluationIndicateurs;



    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
        $this->evaluationIndicateurs = new ArrayCollection();
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

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, EvaluationIndicateur>
     */
    public function getEvaluationIndicateurs(): Collection
    {
        return $this->evaluationIndicateurs;
    }

    public function addEvaluationIndicateur(EvaluationIndicateur $evaluationIndicateur): self
    {
        if (!$this->evaluationIndicateurs->contains($evaluationIndicateur)) {
            $this->evaluationIndicateurs[] = $evaluationIndicateur;
            $evaluationIndicateur->setEleve($this);
        }

        return $this;
    }

    public function removeEvaluationIndicateur(EvaluationIndicateur $evaluationIndicateur): self
    {
        if ($this->evaluationIndicateurs->removeElement($evaluationIndicateur)) {
            // set the owning side to null (unless already changed)
            if ($evaluationIndicateur->getEleve() === $this) {
                $evaluationIndicateur->setEleve(null);
            }
        }

        return $this;
    }

}
