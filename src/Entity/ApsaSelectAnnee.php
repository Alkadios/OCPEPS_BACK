<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApsaSelectAnneeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApsaSelectAnneeRepository::class)
 * @ORM\Table(
 *      name="Apsa_Select_Annee",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"apsa_id", "ca_id" ,"annee_id"})}
 * )
 * @UniqueEntity(
 *      fields={"Apsa", "Ca" , "Annee"},
 *      message="ApsaSelectAnnee for given country already exists in database."
 * )
 */
#[ApiResource(
    normalizationContext: [
        'groups' => ['read:apsaSelectAnne', 'read:caId', 'read:apsaId','write:caId','write:apsaId', 'write:annee','read:apsaLibelle']
    ],
)]
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
    #[Groups(['read:caId' , 'write:caId'])]
    private $Ca;

    /**
     * @ORM\ManyToOne(targetEntity=Apsa::class, inversedBy="apsaSelectAnnees")
     */
    #[Groups(['read:apsaSelectAnne', 'write:apsaId'])]
    private $Apsa;

    /**
     * @ORM\ManyToOne(targetEntity=Annee::class, inversedBy="apsaSelectAnnees")
     */
    #[Groups(['write:annee'])]
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
