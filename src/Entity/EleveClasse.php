<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EleveClasseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=EleveClasseRepository::class)
 * @ORM\Table(
 *      name="eleve_classe",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"eleve_id", "classe_id"})}
 * )
 * @UniqueEntity(
 *      fields={"Eleve","Classe"},
 *      message="ClasseEleve for given entry already exists in database."
 * )
 */
#[ApiResource()]
class EleveClasse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="eleveClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $eleve;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="eleveClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEleve(): ?Eleve
    {
        return $this->eleve;
    }

    public function setEleve(?Eleve $eleve): self
    {
        $this->eleve = $eleve;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
