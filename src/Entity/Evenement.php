<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(length: 2048)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $nombre_places = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Professeur $ref_professeur = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Entreprise $ref_entreprise = null;

    /**
     * @var Collection<int, LinkEtudiantEvenement>
     */
    #[ORM\OneToMany(targetEntity: LinkEtudiantEvenement::class, mappedBy: 'ref_evenement')]
    private Collection $linkEtudiantEvenements;

    public function __construct()
    {
        $this->linkEtudiantEvenements = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

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

    public function getNombrePlaces(): ?int
    {
        return $this->nombre_places;
    }

    public function setNombrePlaces(int $nombre_places): static
    {
        $this->nombre_places = $nombre_places;

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

    public function getRefProfesseur(): ?Professeur
    {
        return $this->ref_professeur;
    }

    public function setRefProfesseur(?Professeur $ref_professeur): static
    {
        $this->ref_professeur = $ref_professeur;

        return $this;
    }

    public function getRefEntreprise(): ?Entreprise
    {
        return $this->ref_entreprise;
    }

    public function setRefEntreprise(?Entreprise $ref_entreprise): static
    {
        $this->ref_entreprise = $ref_entreprise;

        return $this;
    }

    /**
     * @return Collection<int, LinkEtudiantEvenement>
     */
    public function getLinkEtudiantEvenements(): Collection
    {
        return $this->linkEtudiantEvenements;
    }

    public function addLinkEtudiantEvenement(LinkEtudiantEvenement $linkEtudiantEvenement): static
    {
        if (!$this->linkEtudiantEvenements->contains($linkEtudiantEvenement)) {
            $this->linkEtudiantEvenements->add($linkEtudiantEvenement);
            $linkEtudiantEvenement->setRefEvenement($this);
        }

        return $this;
    }

    public function removeLinkEtudiantEvenement(LinkEtudiantEvenement $linkEtudiantEvenement): static
    {
        if ($this->linkEtudiantEvenements->removeElement($linkEtudiantEvenement)) {
            // set the owning side to null (unless already changed)
            if ($linkEtudiantEvenement->getRefEvenement() === $this) {
                $linkEtudiantEvenement->setRefEvenement(null);
            }
        }

        return $this;
    }
}
