<?php

namespace App\Entity;

use App\Repository\CableInterBoxRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CableInterBoxRepository::class)]
class CableInterBox
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'cableInterBoxSrc1', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Box $source1 = null;

    #[ORM\OneToOne(inversedBy: 'cableInterBoxSrc2', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Box $source2 = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $dateInstallation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSource1(): ?Box
    {
        return $this->source1;
    }

    public function setSource1(Box $source1): static
    {
        $this->source1 = $source1;

        return $this;
    }

    public function getSource2(): ?Box
    {
        return $this->source2;
    }

    public function setSource2(Box $source2): static
    {
        $this->source2 = $source2;

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
