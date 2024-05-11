<?php

namespace App\Entity;

use App\Repository\OltRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OltRepository::class)]
class Olt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $loc = null;

    #[ORM\Column(length: 255)]
    private ?string $gps = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'olts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Projet $projet = null;

    #[ORM\ManyToOne(inversedBy: 'olts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeOlt $type = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $dateInstallation = null;

    #[ORM\Column(length: 255)]
    private ?string $vlanManagement = null;

    #[ORM\Column(length: 255)]
    private ?string $portMetro = null;

    #[ORM\Column(length: 255)]
    private ?string $capacitePortMetro = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseManagement = null;

    /**
     * @var Collection<int, ReceptionOlt>
     */
    #[ORM\OneToMany(targetEntity: ReceptionOlt::class, mappedBy: 'olt')]
    private Collection $receptionOlts;

    public function __construct()
    {
        $this->receptionOlts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoc(): ?string
    {
        return $this->loc;
    }

    public function setLoc(string $loc): static
    {
        $this->loc = $loc;

        return $this;
    }

    public function getGps(): ?string
    {
        return $this->gps;
    }

    public function setGps(string $gps): static
    {
        $this->gps = $gps;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): static
    {
        $this->projet = $projet;

        return $this;
    }

    public function getType(): ?TypeOlt
    {
        return $this->type;
    }

    public function setType(?TypeOlt $type): static
    {
        $this->type = $type;

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

    public function getVlanManagement(): ?string
    {
        return $this->vlanManagement;
    }

    public function setVlanManagement(string $vlanManagement): static
    {
        $this->vlanManagement = $vlanManagement;

        return $this;
    }

    public function getPortMetro(): ?string
    {
        return $this->portMetro;
    }

    public function setPortMetro(string $portMetro): static
    {
        $this->portMetro = $portMetro;

        return $this;
    }

    public function getCapacitePortMetro(): ?string
    {
        return $this->capacitePortMetro;
    }

    public function setCapacitePortMetro(string $capacitePortMetro): static
    {
        $this->capacitePortMetro = $capacitePortMetro;

        return $this;
    }

    public function getAdresseManagement(): ?string
    {
        return $this->adresseManagement;
    }

    public function setAdresseManagement(string $adresseManagement): static
    {
        $this->adresseManagement = $adresseManagement;

        return $this;
    }

    /**
     * @return Collection<int, ReceptionOlt>
     */
    public function getReceptionOlts(): Collection
    {
        return $this->receptionOlts;
    }

    public function addReceptionOlt(ReceptionOlt $receptionOlt): static
    {
        if (!$this->receptionOlts->contains($receptionOlt)) {
            $this->receptionOlts->add($receptionOlt);
            $receptionOlt->setOlt($this);
        }

        return $this;
    }

    public function removeReceptionOlt(ReceptionOlt $receptionOlt): static
    {
        if ($this->receptionOlts->removeElement($receptionOlt)) {
            // set the owning side to null (unless already changed)
            if ($receptionOlt->getOlt() === $this) {
                $receptionOlt->setOlt(null);
            }
        }

        return $this;
    }
}
