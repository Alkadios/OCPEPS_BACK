<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EtablissementRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:etablissement']
            ],
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:etablissement', 'post:professeur']
            ],
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:etablissement']
            ],
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            'normalization_context' => [
                'groups' => ['delete:etablissement']
            ],
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            'denormalization_context' => [
                'groups' => ['put:etablissement']
            ],
            'normalization_context' => [
                'groups' => ['read:etablissement', 'read:professeur']
            ],
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_ADMIN')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ]
)]

class Etablissement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:etablissement', 'read:caId','put:etablissement', 'read:eleve'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:etablissement','read:classe','put:etablissement', 'read:eleve'])]
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:etablissement' , 'put:etablissement'])]
    private $cp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="etablissement")
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $Classe;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="etablissement")
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $Eleve;

    /**
     * @ORM\ManyToMany(targetEntity=Professeur::class, inversedBy="etablissements")
     */
    #[Groups(['read:etablissement', 'read:professeurs' , 'put:etablissement'])]
    private $Professeur;

    /**
     * @ORM\OneToMany(targetEntity=ApsaSelectAnnee::class, mappedBy="etablissement")
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $ApsaSelectAnnee;

    /**
     * @ORM\ManyToMany(targetEntity=NiveauScolaire::class, inversedBy="etablissements")
     */
    #[Groups(['read:etablissement'])]
    private $niveauScolaire;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="etablissement", orphanRemoval=true)
     */
    #[Groups(['read:etablissement', 'put:etablissement'])]
    private $choixAnnee;

    public function __construct()
    {
        $this->Classe = new ArrayCollection();
        $this->Eleve = new ArrayCollection();
        $this->Professeur = new ArrayCollection();
        $this->ApsaSelectAnnee = new ArrayCollection();
        $this->niveauScolaire = new ArrayCollection();
        $this->choixAnnee = new ArrayCollection();
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

    /**
     * @return Collection<int, NiveauScolaire>
     */
    public function getNiveauScolaire(): Collection
    {
        return $this->niveauScolaire;
    }

    public function addNiveauScolaire(NiveauScolaire $niveauScolaire): self
    {
        if (!$this->niveauScolaire->contains($niveauScolaire)) {
            $this->niveauScolaire[] = $niveauScolaire;
        }

        return $this;
    }

    public function removeNiveauScolaire(NiveauScolaire $niveauScolaire): self
    {
        $this->niveauScolaire->removeElement($niveauScolaire);

        return $this;
    }

    /**
     * @return Collection<int, ChoixAnnee>
     */
    public function getChoixAnnee(): Collection
    {
        return $this->choixAnnee;
    }

    public function addChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if (!$this->choixAnnee->contains($choixAnnee)) {
            $this->choixAnnee[] = $choixAnnee;
            $choixAnnee->setEtablissement($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->choixAnnee->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getEtablissement() === $this) {
                $choixAnnee->setEtablissement(null);
            }
        }

        return $this;
    }


}
