<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
#[ApiResource(
    collectionOperations: [
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
)]
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:cours'])]
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    #[Groups(['read:cours'])]
    private $heureDebut;

    /**
     * @ORM\Column(type="time")
     */
    #[Groups(['read:cours'])]
    private $heureFin;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="cours")
     */
    private $Professeur;

    /**
     * @ORM\ManyToOne(targetEntity=InstallationSportive::class, inversedBy="Cours")
     */
    #[Groups(['read:cours'])]
    private $installationSportive;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTimeInterface $heureDebut): self
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heureFin;
    }

    public function setHeureFin(\DateTimeInterface $heureFin): self
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->Professeur;
    }

    public function setProfesseur(?Professeur $Professeur): self
    {
        $this->Professeur = $Professeur;

        return $this;
    }

    public function getInstallationSportive(): ?InstallationSportive
    {
        return $this->installationSportive;
    }

    public function setInstallationSportive(?InstallationSportive $installationSportive): self
    {
        $this->installationSportive = $installationSportive;

        return $this;
    }


}
