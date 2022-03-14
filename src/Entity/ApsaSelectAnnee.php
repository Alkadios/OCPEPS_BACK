<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApsaSelectAnneeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ApsaSelectAnneeRepository::class)
 * @ORM\Table(
 *      name="Apsa_Select_Annee",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "ca_id" ,"annee_id"})}
 * )
 * @UniqueEntity(
 *      fields={"apsa_id", "ca_id" , "annee_id"},
 *      message="ApsaSelectAnnee for given country already exists in database."
 * )
 * @ApiResource()
 */
class ApsaSelectAnnee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ChampApprentissage::class, inversedBy="apsaSelectAnnees")
     */
    private $Ca;

    /**
     * @ORM\ManyToOne(targetEntity=Apsa::class, inversedBy="apsaSelectAnnees")
     */
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="apsaSelectAnnees")
     */
    private $Annee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCa(): ?ChampApprentissage
    {
        return $this->Ca;
    }

    public function setCa(?ChampApprentissage $Ca): self
    {
        $this->Ca = $Ca;

        return $this;
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

    public function getAnnee(): ?Annee
    {
        return $this->Annee;
    }

    public function setAnnee(?Annee $Annee): self
    {
        $this->Annee = $Annee;

        return $this;
    }
}
