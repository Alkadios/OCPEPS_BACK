<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ProfesseurClasseRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProfesseurClasseRepository::class)
 * @ORM\Table(
 *      name="professeur_classe",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"professeur_id", "classe_id"})}
 * )
 * @UniqueEntity(
 *      fields={"Professeur","Classe"},
 *      message="ProfesseurClasse for given entry already exists in database."
 * )
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:professeurClasse']
            ]
        ]
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['professeur.id' => 'exact'])]
class ProfesseurClasse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:professeurClasse'])]
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Professeur::class, inversedBy="professeurClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:professeurClasse'])]
    private $professeur;

    /**
     * @ORM\ManyToOne(targetEntity=Classe::class, inversedBy="professeurClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    #[Groups(['read:professeurClasse'])]
    private $classe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProfesseur(): ?Professeur
    {
        return $this->professeur;
    }

    public function setProfesseur(?Professeur $professeur): self
    {
        $this->professeur = $professeur;

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
