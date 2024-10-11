<?php

namespace App\Entity;

use App\Repository\LinkEtudiantEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinkEtudiantEvenementRepository::class)]
class LinkEtudiantEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'linkEtudiantEvenements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $ref_etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'linkEtudiantEvenements')]
    private ?Evenement $ref_evenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefEtudiant(): ?Etudiant
    {
        return $this->ref_etudiant;
    }

    public function setRefEtudiant(?Etudiant $ref_etudiant): static
    {
        $this->ref_etudiant = $ref_etudiant;

        return $this;
    }

    public function getRefEvenement(): ?Evenement
    {
        return $this->ref_evenement;
    }

    public function setRefEvenement(?Evenement $ref_evenement): static
    {
        $this->ref_evenement = $ref_evenement;

        return $this;
    }
}
