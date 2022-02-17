<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CycleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CycleRepository::class)
 * @ApiResource()
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:niveauScolaire', 'read:classe']
    ]
)]
class Cycle
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
     * @ORM\OneToMany(targetEntity=NiveauScolaire::class, mappedBy="cycle")
     */
    #[Groups(['read:niveauScolaire'])]
    private $niveauScolaires;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="cycle")
     */
    #[Groups(['read:classe'])]
    private $classes;

    public function __construct()
    {
        $this->niveauScolaires = new ArrayCollection();
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

    /**
     * @return Collection|NiveauScolaire[]
     */
    public function getNiveauScolaires(): Collection
    {
        return $this->niveauScolaires;
    }

    public function addNiveauScolaire(NiveauScolaire $niveauScolaire): self
    {
        if (!$this->niveauScolaires->contains($niveauScolaire)) {
            $this->niveauScolaires[] = $niveauScolaire;
            $niveauScolaire->setCycle($this);
        }

        return $this;
    }

    public function removeNiveauScolaire(NiveauScolaire $niveauScolaire): self
    {
        if ($this->niveauScolaires->removeElement($niveauScolaire)) {
            // set the owning side to null (unless already changed)
            if ($niveauScolaire->getCycle() === $this) {
                $niveauScolaire->setCycle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Classe[]
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): self
    {
        if (!$this->classes->contains($class)) {
            $this->classes[] = $class;
            $class->setCycle($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getCycle() === $this) {
                $class->setCycle(null);
            }
        }

        return $this;
    }
}
