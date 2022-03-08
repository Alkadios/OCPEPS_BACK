<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChampsApprentissageApsaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChampsApprentissageApsaRepository::class)
 * @ORM\Table(
 *      name="champsapprentissageapsa",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "champ_apprentissage_id"})}
 * )
 * @UniqueEntity(
 *      fields={"apsa_id","champ_apprentissage_id"},
 *      message="champapprentissageAPsa for given country already exists in database."
 * )
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:apsa', 'read:champapprentissage'],
    ]
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
    #[Groups('read:apsa')]
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="champsApprentissageApsas")
     */
    #[Groups('read:champapprentissage')]
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
