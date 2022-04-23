<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtablissementRepository::class)
 */
#[ApiResource()]
class Etablissement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="etablissement")
     */
    private $Classe;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="etablissement")
     */
    private $Eleve;

    /**
     * @ORM\ManyToMany(targetEntity=Professeur::class, inversedBy="etablissements")
     */
    private $Professeur;

    /**
     * @ORM\OneToMany(targetEntity=ApsaSelectAnnee::class, mappedBy="etablissement")
     */
    private $ApsaSelectAnnee;

    public function __construct()
    {
        $this->Classe = new ArrayCollection();
        $this->Eleve = new ArrayCollection();
        $this->Professeur = new ArrayCollection();
        $this->ApsaSelectAnnee = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(?string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasse(): Collection
    {
        return $this->Classe;
    }

    public function addClasse(Classe $classe): self
    {
        if (!$this->Classe->contains($classe)) {
            $this->Classe[] = $classe;
            $classe->setEtablissement($this);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): self
    {
        if ($this->Classe->removeElement($classe)) {
            // set the owning side to null (unless already changed)
            if ($classe->getEtablissement() === $this) {
                $classe->setEtablissement(null);
            }
        }

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
            $eleve->setEtablissement($this);
        }

        return $this;
    }

    public function removeEleve(Eleve $eleve): self
    {
        if ($this->Eleve->removeElement($eleve)) {
            // set the owning side to null (unless already changed)
            if ($eleve->getEtablissement() === $this) {
                $eleve->setEtablissement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Professeur>
     */
    public function getProfesseur(): Collection
    {
        return $this->Professeur;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->Professeur->contains($professeur)) {
            $this->Professeur[] = $professeur;
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        $this->Professeur->removeElement($professeur);

        return $this;
    }

    /**
     * @return Collection<int, ApsaSelectAnnee>
     */
    public function getApsaSelectAnnee(): Collection
    {
        return $this->ApsaSelectAnnee;
    }

    public function addApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if (!$this->ApsaSelectAnnee->contains($apsaSelectAnnee)) {
            $this->ApsaSelectAnnee[] = $apsaSelectAnnee;
            $apsaSelectAnnee->setEtablissement($this);
        }

        return $this;
    }

    public function removeApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if ($this->ApsaSelectAnnee->removeElement($apsaSelectAnnee)) {
            // set the owning side to null (unless already changed)
            if ($apsaSelectAnnee->getEtablissement() === $this) {
                $apsaSelectAnnee->setEtablissement(null);
            }
        }

        return $this;
    }
}
