<?php

namespace App\Entity;

use App\Repository\ReceptionOltRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReceptionOltRepository::class)]
class ReceptionOlt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'receptionOlts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Olt $olt = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOlt(): ?Olt
    {
        return $this->olt;
    }

    public function setOlt(?Olt $olt): static
    {
        $this->olt = $olt;

        return $this;
    }
}
