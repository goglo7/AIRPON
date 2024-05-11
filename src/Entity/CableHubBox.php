<?php

namespace App\Entity;

use App\Repository\CableHubBoxRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CableHubBoxRepository::class)]
class CableHubBox
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cableHubBoxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hub $hub = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Box $box = null;

    #[ORM\Column(length: 255)]
    private ?string $longueur = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $dateInstallation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHub(): ?Hub
    {
        return $this->hub;
    }

    public function setHub(?Hub $hub): static
    {
        $this->hub = $hub;

        return $this;
    }

    public function getBox(): ?Box
    {
        return $this->box;
    }

    public function setBox(Box $box): static
    {
        $this->box = $box;

        return $this;
    }

    public function getLongueur(): ?string
    {
        return $this->longueur;
    }

    public function setLongueur(string $longueur): static
    {
        $this->longueur = $longueur;

        return $this;
    }

    public function getDateInstallation(): ?\DateTimeInterface
    {
        return $this->dateInstallation;
    }

    public function setDateInstallation(\DateTimeInterface $dateInstallation): static
    {
        $this->dateInstallation = $dateInstallation;

        return $this;
    }
}
