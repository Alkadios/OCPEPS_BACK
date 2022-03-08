<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChampApprentissageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChampApprentissageRepository::class)
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:apsa'],
    ]
)]
class ChampApprentissage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:apsa', 'read:champapprentissage'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:apsa', 'read:champapprentissage'])]
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="champApprentissage")
     */
    private $ChoixAnnee;


    /**
     * @ORM\ManyToMany(targetEntity=Apsa::class, mappedBy="ChampsApprentissage")
     */
    private $apsas;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    public function __construct()
    {
        $this->ChoixAnnee = new ArrayCollection();
        $this->Apsa = new ArrayCollection();
        $this->apsas = new ArrayCollection();
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
     * @return Collection|ChoixAnnee[]
     */
    public function getChoixAnnee(): Collection
    {
        return $this->ChoixAnnee;
    }

    public function addChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if (!$this->ChoixAnnee->contains($choixAnnee)) {
            $this->ChoixAnnee[] = $choixAnnee;
            $choixAnnee->setChampApprentissage($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->ChoixAnnee->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getChampApprentissage() === $this) {
                $choixAnnee->setChampApprentissage(null);
            }
        }

        return $this;
    }



    /**
     * @return Collection|Apsa[]
     */
    public function getApsas(): Collection
    {
        return $this->apsas;
    }

    public function addApsa(Apsa $apsa): self
    {
        if (!$this->apsas->contains($apsa)) {
            $this->apsas[] = $apsa;
            $apsa->addChampsApprentissage($this);
        }

        return $this;
    }

    public function removeApsa(Apsa $apsa): self
    {
        if ($this->apsas->removeElement($apsa)) {
            $apsa->removeChampsApprentissage($this);
        }

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
