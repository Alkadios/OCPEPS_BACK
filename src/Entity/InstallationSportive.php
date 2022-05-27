<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InstallationSportiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=InstallationSportiveRepository::class)
 */
#[ApiResource(collectionOperations: [
    'get' => [
        "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
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
        'groups' => ['read:installation', 'read:cours']
    ]
)]
class InstallationSportive
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:installation'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:installation'])]
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:installation'])]
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Cours::class, mappedBy="installationSportive")
     */
    #[Groups(['read:cours'])]
    private $Cours;

    public function __construct()
    {
        $this->Cours = new ArrayCollection();
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

    /**
     * @return Collection|Cours[]
     */
    public function getCours(): Collection
    {
        return $this->Cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->Cours->contains($cour)) {
            $this->Cours[] = $cour;
            $cour->setInstallationSportive($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->Cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getInstallationSportive() === $this) {
                $cour->setInstallationSportive(null);
            }
        }

        return $this;
    }
}
