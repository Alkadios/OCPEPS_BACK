<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ApsaChampApprentissageController;
use App\Repository\CritereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CritereRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['read:critere', 'read:apsaRetenu']
            ],
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'post' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
    ],
    itemOperations: [
        'get' => [
            "security" => "is_granted('ROLE_USER')",
            'openapi_context' => [
                'security' => [['bearerAuth' => []]]
            ],
        ],
        'put' => [
            "security" => "is_granted('ROLE_USER')'",
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
    ],
)]
#[ApiFilter(SearchFilter::class, properties: ['ApsaRetenu.id' => 'exact', 'ApsaRetenu.ApsaSelectAnnee.Apsa.id' => 'exact', 'ApsaRetenu.ApsaSelectAnnee.Annee.id' => 'exact', 'ApsaRetenu.AfRetenu.id' => 'exact'])]
class Critere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['read:critere', 'read:apsaSelectAnnee'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:critere', 'read:apsaSelectAnnee'])]
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['read:critere', 'read:apsaSelectAnnee'])]
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(['read:critere', 'read:apsaSelectAnnee'])]
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    #[Groups(['read:critere', 'read:apsaSelectAnnee'])]
    private $url_video;

    /**
     * @ORM\ManyToOne(targetEntity=ApsaRetenu::class, inversedBy="criteres")
     * @ORM\JoinColumn(name="apsa_retenu_id", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     */
    #[Groups(['read:apsaRetenu'])]
    private $ApsaRetenu;

    /**
     * @ORM\OneToMany(targetEntity=Indicateur::class, mappedBy="critere")
     */
    #[Groups(['read:critere', 'read:apsaSelectAnnee', 'read:ordreIndicateur'])]
    private $Indicateur;

    public function __construct()
    {
        $this->Indicateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getUrlVideo(): ?string
    {
        return $this->url_video;
    }

    public function setUrlVideo(?string $url_video): self
    {
        $this->url_video = $url_video;

        return $this;
    }

    public function getApsaRetenu(): ?ApsaRetenu
    {
        return $this->ApsaRetenu;
    }

    public function setApsaRetenu(?ApsaRetenu $ApsaRetenu): self
    {
        $this->ApsaRetenu = $ApsaRetenu;

        return $this;
    }

    /**
     * @return Collection<int, Indicateur>
     */
    public function getIndicateur(): Collection
    {
        return $this->Indicateur;
    }

    public function addIndicateur(Indicateur $indicateur): self
    {
        if (!$this->Indicateur->contains($indicateur)) {
            $this->Indicateur[] = $indicateur;
            $indicateur->setCritere($this);
        }

        return $this;
    }

    public function removeIndicateur(Indicateur $indicateur): self
    {
        if ($this->Indicateur->removeElement($indicateur)) {
            // set the owning side to null (unless already changed)
            if ($indicateur->getCritere() === $this) {
                $indicateur->setCritere(null);
            }
        }

        return $this;
    }
}
