<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CritereRepository::class)
 * @ApiResource()
 */
class Critere
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $url_video;

    /**
     * @ORM\ManyToOne(targetEntity=ApsaRetenu::class, inversedBy="criteres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ApsaRetenu;

    /**
     * @ORM\OneToMany(targetEntity=Indicateur::class, mappedBy="critere")
     */
    private $Indicateur;

    public function __construct()
    {
        $this->Indicateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUrlVideo(): ?string
    {
        return $this->url_video;
    }

    public function setUrlVideo(?string $url_video): self
    {
        $this->url_video = $url_video;

        return $this;
    }

    public function getApsaRetenu(): ?ApsaRetenu
    {
        return $this->ApsaRetenu;
    }

    public function setApsaRetenu(?ApsaRetenu $ApsaRetenu): self
    {
        $this->ApsaRetenu = $ApsaRetenu;

        return $this;
    }

    /**
     * @return Collection<int, Indicateur>
     */
    public function getIndicateur(): Collection
    {
        return $this->Indicateur;
    }

    public function addIndicateur(Indicateur $indicateur): self
    {
        if (!$this->Indicateur->contains($indicateur)) {
            $this->Indicateur[] = $indicateur;
            $indicateur->setCritere($this);
        }

        return $this;
    }

    public function removeIndicateur(Indicateur $indicateur): self
    {
        if ($this->Indicateur->removeElement($indicateur)) {
            // set the owning side to null (unless already changed)
            if ($indicateur->getCritere() === $this) {
                $indicateur->setCritere(null);
            }
        }

        return $this;
    }
}
