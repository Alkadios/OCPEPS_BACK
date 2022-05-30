<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AnneeRepository;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AnneeRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:annee']
            ]
        ],
        'post' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ]
)]
#[ApiFilter(BooleanFilter::class, properties: ['enCours' => 'exact'])]
class Annee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['post:apsaSelectAnnee', 'read:apsaSelectAnnee','read:caId', 'read:annee', 'read:eleveApsa'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:annee','read:classe', 'read:eleveApsa'])]
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity=ChoixAnnee::class, mappedBy="Annee")
     */
    #[Groups(['read:apsaSelectAnnee', 'read:caId'])]
    private $choixAnnees;

    /**
     * @ORM\OneToMany(targetEntity=ApsaSelectAnnee::class, mappedBy="Annee")
     */
    #[Groups(['read:apsaSelectAnnee', 'read:eleveApsa'])]
    private $apsaSelectAnnees;

    /**
     * @ORM\OneToMany(targetEntity=Classe::class, mappedBy="Annee")
     */
    #[Groups(['read:apsaSelectAnnee'])]
    private $classes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    #[Groups(['read:apsaSelectAnnee'])]
    private $enCours;

    public function __construct()
    {
        $this->choixAnnees = new ArrayCollection();
        $this->apsaSelectAnnees = new ArrayCollection();
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

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
            $choixAnnee->setAnnee($this);
        }

        return $this;
    }

    public function removeChoixAnnee(ChoixAnnee $choixAnnee): self
    {
        if ($this->choixAnnees->removeElement($choixAnnee)) {
            // set the owning side to null (unless already changed)
            if ($choixAnnee->getAnnee() === $this) {
                $choixAnnee->setAnnee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ApsaSelectAnnee[]
     */
    public function getApsaSelectAnnees(): Collection
    {
        return $this->apsaSelectAnnees;
    }

    public function addApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if (!$this->apsaSelectAnnees->contains($apsaSelectAnnee)) {
            $this->apsaSelectAnnees[] = $apsaSelectAnnee;
            $apsaSelectAnnee->setAnnee($this);
        }

        return $this;
    }

    public function removeApsaSelectAnnee(ApsaSelectAnnee $apsaSelectAnnee): self
    {
        if ($this->apsaSelectAnnees->removeElement($apsaSelectAnnee)) {
            // set the owning side to null (unless already changed)
            if ($apsaSelectAnnee->getAnnee() === $this) {
                $apsaSelectAnnee->setAnnee(null);
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
            $class->setAnnee($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): self
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getAnnee() === $this) {
                $class->setAnnee(null);
            }
        }

        return $this;
    }

    public function getEnCours(): ?bool
    {
        return $this->enCours;
    }

    public function setEnCours(?bool $en_cours): self
    {
        $this->enCours = $en_cours;

        return $this;
    }
}
