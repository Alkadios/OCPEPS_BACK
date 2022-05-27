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
    collectionOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN, 'ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'patch' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'delete' => [
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
    ],
    normalizationContext: [
        'groups' => ['read:niveauScolaire']
    ]
)]
class Cycle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:niveauScolaire', 'read:cycle'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:niveauScolaire', 'read:cycle'])]
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=NiveauScolaire::class, mappedBy="cycle")
     */
    private $niveauScolaires;


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

}
