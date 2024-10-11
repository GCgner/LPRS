<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreRepository::class)]
class Offre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 2048)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'offres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?entreprise $ref_entreprise = null;

    /**
     * @var Collection<int, LinkEtudiantOffre>
     */
    #[ORM\OneToMany(targetEntity: LinkEtudiantOffre::class, mappedBy: 'ref_offre', orphanRemoval: true)]
    private Collection $linkEtudiantOffres;

    public function __construct()
    {
        $this->linkEtudiantOffres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getRefEntreprise(): ?entreprise
    {
        return $this->ref_entreprise;
    }

    public function setRefEntreprise(?entreprise $ref_entreprise): static
    {
        $this->ref_entreprise = $ref_entreprise;

        return $this;
    }

    /**
     * @return Collection<int, LinkEtudiantOffre>
     */
    public function getLinkEtudiantOffres(): Collection
    {
        return $this->linkEtudiantOffres;
    }

    public function addLinkEtudiantOffre(LinkEtudiantOffre $linkEtudiantOffre): static
    {
        if (!$this->linkEtudiantOffres->contains($linkEtudiantOffre)) {
            $this->linkEtudiantOffres->add($linkEtudiantOffre);
            $linkEtudiantOffre->setRefOffre($this);
        }

        return $this;
    }

    public function removeLinkEtudiantOffre(LinkEtudiantOffre $linkEtudiantOffre): static
    {
        if ($this->linkEtudiantOffres->removeElement($linkEtudiantOffre)) {
            // set the owning side to null (unless already changed)
            if ($linkEtudiantOffre->getRefOffre() === $this) {
                $linkEtudiantOffre->setRefOffre(null);
            }
        }

        return $this;
    }
}
