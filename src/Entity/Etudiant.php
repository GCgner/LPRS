<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4)]
    private ?string $annee = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $cv = null;

    #[ORM\Column(length: 255)]
    private ?string $poste_entreprise = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $ref_utilisateur = null;

    /**
     * @var Collection<int, Alumni>
     */
    #[ORM\OneToMany(targetEntity: Alumni::class, mappedBy: 'ref_etudiant', orphanRemoval: true)]
    private Collection $alumnis;

    public function __construct()
    {
        $this->alumnis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getPosteEntreprise(): ?string
    {
        return $this->poste_entreprise;
    }

    public function setPosteEntreprise(string $poste_entreprise): static
    {
        $this->poste_entreprise = $poste_entreprise;

        return $this;
    }

    public function getRefUtilisateur(): ?User
    {
        return $this->ref_utilisateur;
    }

    public function setRefUtilisateur(?User $ref_utilisateur): static
    {
        $this->ref_utilisateur = $ref_utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Alumni>
     */
    public function getAlumnis(): Collection
    {
        return $this->alumnis;
    }

    public function addAlumni(Alumni $alumni): static
    {
        if (!$this->alumnis->contains($alumni)) {
            $this->alumnis->add($alumni);
            $alumni->setRefEtudiant($this);
        }

        return $this;
    }

    public function removeAlumni(Alumni $alumni): static
    {
        if ($this->alumnis->removeElement($alumni)) {
            // set the owning side to null (unless already changed)
            if ($alumni->getRefEtudiant() === $this) {
                $alumni->setRefEtudiant(null);
            }
        }

        return $this;
    }
}
