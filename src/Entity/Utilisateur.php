<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ApiResource()
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    // /**
    //  * @ORM\Column(type="json")
    //  */
    // private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="utilisateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity=Eleve::class, mappedBy="utilisateur")
     */
    private $eleves;

    /**
     * @ORM\OneToMany(targetEntity=Professeur::class, mappedBy="utilisateur")
     */
    private $professeurs;


    public function __construct()
    {
        $this->disponibilites = new ArrayCollection();
        $this->choixDispoEleves = new ArrayCollection();
        $this->apointments = new ArrayCollection();
        $this->paiements = new ArrayCollection();
        $this->examenDemandes = new ArrayCollection();
        $this->testEleves = new ArrayCollection();
        $this->examenCodes = new ArrayCollection();
        $this->eleves = new ArrayCollection();
        $this->professeurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    // /**
    //  * @see UserInterface
    //  */
    public function getRoles(): array
    {
        $var = $this->roles;

        return array($var); // We need to return an array
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }


    //intelephense mets une erreur ici mais ça fonctionne
    public function getRole(): ?Role
    {
        return $this->roles;
    }

    public function setRole(?role $role): self
    {
        $this->roles = $role;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection|Eleve[]
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleve $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves[] = $elefe;
            $elefe->setUtilisateur($this);
        }

        return $this;
    }

    public function removeElefe(Eleve $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getUtilisateur() === $this) {
                $elefe->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Professeur[]
     */
    public function getProfesseurs(): Collection
    {
        return $this->professeurs;
    }

    public function addProfesseur(Professeur $professeur): self
    {
        if (!$this->professeurs->contains($professeur)) {
            $this->professeurs[] = $professeur;
            $professeur->setUtilisateur($this);
        }

        return $this;
    }

    public function removeProfesseur(Professeur $professeur): self
    {
        if ($this->professeurs->removeElement($professeur)) {
            // set the owning side to null (unless already changed)
            if ($professeur->getUtilisateur() === $this) {
                $professeur->setUtilisateur(null);
            }
        }

        return $this;
    }



}
