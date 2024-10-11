<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2048)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_heure_reponse = null;

    #[ORM\ManyToOne(inversedBy: 'reponses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poste $ref_poste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getDateHeureReponse(): ?\DateTimeInterface
    {
        return $this->date_heure_reponse;
    }

    public function setDateHeureReponse(\DateTimeInterface $date_heure_reponse): static
    {
        $this->date_heure_reponse = $date_heure_reponse;

        return $this;
    }

    public function getRefPoste(): ?Poste
    {
        return $this->ref_poste;
    }

    public function setRefPoste(?Poste $ref_poste): static
    {
        $this->ref_poste = $ref_poste;

        return $this;
    }
}
