<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CAController;
use App\Repository\ChampsApprentissageApsaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChampsApprentissageApsaRepository::class)
 * @ORM\Table(
 *      name="champs_apprentissage_apsa",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "champ_apprentissage_id"})}
 * )
 * @UniqueEntity(
 *      fields={"Apsa","ChampApprentissage"},
 *      message="champapprentissageAPsa for given country already exists in database."
 * )
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'noarmalization_context' => [
                'groups' => ['read:apsa', 'read:champapprentissage'],
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            'denormalization_context' => [
                'groups' => ['post:ChampsApprentissageApsa']
            ],
            "security" => "is_granted('ROLE_ADMIN', 'ROLE_USER)",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ]
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
class ChampsApprentissageApsa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Apsa::class, inversedBy="champsApprentissageApsas")
     */
    #[Groups(['read:apsa', 'post:ChampsApprentissageApsa'])]
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="champsApprentissageApsas")
     */
    #[Groups(['read:champapprentissage', 'post:ChampsApprentissageApsa', 'read:apsaRetenu'])]
    private $ChampApprentissage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApsa(): ?Apsa
    {
        return $this->Apsa;
    }

    public function setApsa(?Apsa $Apsa): self
    {
        $this->Apsa = $Apsa;

        return $this;
    }

    public function getChampApprentissage(): ?ChampApprentissage
    {
        return $this->ChampApprentissage;
    }

    public function setChampApprentissage(?ChampApprentissage $ChampApprentissage): self
    {
        $this->ChampApprentissage = $ChampApprentissage;

        return $this;
    }
}
