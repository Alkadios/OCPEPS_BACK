<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\NiveauScolaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=NiveauScolaireRepository::class)
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:niveauScolaire', 'read:cycle']
    ],
    paginationEnabled: false
)]

#[ApiFilter(SearchFilter::class, properties: ['cycle.id' => 'exact'])]
class NiveauScolaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:niveauScolaire'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:niveauScolaire'])]
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Cycle::class, inversedBy="niveauScolaires")
     */
    #[Groups(['read:cycle'])]
    private $cycle;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="Niveau")
     */
    private $choixAnnees;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="NiveauScolaire", orphanRemoval=true)
     */
    private $classes;

    public function __construct()
    {
        $this->choixAnnees = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCycle(): ?Cycle
    {
        return $this->cycle;
    }

    public function setCycle(?Cycle $cycle): self
    {
        $this->cycle = $cycle;

        return $this;
    }

    /**
     * @return Collection|ChoixAnnee[]
     */
    public function getChoixAnnees(): Collection
    {
        return $this->choixAnnees;
    }

    public function addChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if (!$this->choixAnnees->contains($choixAnnee)) {
            $this->choixAnnees[] = $choixAnnee;
            $choixAnnee->setNiveau($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->choixAnnees->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getNiveau() === $this) {
                $choixAnnee->setNiveau(null);
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
            $class->setNiveauScolaire($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getNiveauScolaire() === $this) {
                $class->setNiveauScolaire(null);
            }
        }

        return $this;
    }
}
