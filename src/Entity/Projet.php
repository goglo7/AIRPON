<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'projets')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Direction $direction = null;

    /**
     * @var Collection<int, Olt>
     */
    #[ORM\OneToMany(targetEntity: Olt::class, mappedBy: 'projet')]
    private Collection $olts;

    public function __construct()
    {
        $this->olts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

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

    public function getDirection(): ?Direction
    {
        return $this->direction;
    }

    public function setDirection(?Direction $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return Collection<int, Olt>
     */
    public function getOlts(): Collection
    {
        return $this->olts;
    }

    public function addOlt(Olt $olt): static
    {
        if (!$this->olts->contains($olt)) {
            $this->olts->add($olt);
            $olt->setProjet($this);
        }

        return $this;
    }

    public function removeOlt(Olt $olt): static
    {
        if ($this->olts->removeElement($olt)) {
            // set the owning side to null (unless already changed)
            if ($olt->getProjet() === $this) {
                $olt->setProjet(null);
            }
        }

        return $this;
    }
}
