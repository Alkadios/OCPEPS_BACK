<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AfRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AfRepository::class)
 */
#[ApiResource()]
class Af
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:Af','read:choixAnnee'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:Af', 'read:AfRetenu','read:choixAnnee'])]
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=AfRetenu::class, mappedBy="Af")
     */
    private $afRetenus;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="afs")
     */
    private $ca;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $typeAf;


    public function __construct()
    {
        $this->AfRetenu = new ArrayCollection();
        $this->afRetenus = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|AfRetenu[]
     */
    public function getAfRetenus(): Collection
    {
        return $this->afRetenus;
    }

    public function addAfRetenu(AfRetenu $afRetenu): self
    {
        if (!$this->afRetenus->contains($afRetenu)) {
            $this->afRetenus[] = $afRetenu;
            $afRetenu->setAf($this);
        }

        return $this;
    }

    public function removeAfRetenu(AfRetenu $afRetenu): self
    {
        if ($this->afRetenus->removeElement($afRetenu)) {
            // set the owning side to null (unless already changed)
            if ($afRetenu->getAf() === $this) {
                $afRetenu->setAf(null);
            }
        }

        return $this;
    }

    public function getCa(): ?ChampApprentissage
    {
        return $this->ca;
    }

    public function setCa(?ChampApprentissage $ca): self
    {
        $this->ca = $ca;

        return $this;
    }

    public function getTypeAf(): ?string
    {
        return $this->typeAf;
    }

    public function setTypeAf(?string $typeAf): self
    {
        $this->typeAf = $typeAf;

        return $this;
    }


}
