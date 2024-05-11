<?php

namespace App\Entity;

use App\Repository\ModemOntRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModemOntRepository::class)]
class ModemOnt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $numSerie = null;

    #[ORM\Column(length: 255)]
    private ?string $caracteristiques = null;

    /**
     * @var Collection<int, AirponClient>
     */
    #[ORM\OneToMany(targetEntity: AirponClient::class, mappedBy: 'modemOnt')]
    private Collection $airponClients;

    public function __construct()
    {
        $this->airponClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSerie(): ?string
    {
        return $this->numSerie;
    }

    public function setNumSerie(string $numSerie): static
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    public function getCaracteristiques(): ?string
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(string $caracteristiques): static
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    /**
     * @return Collection<int, AirponClient>
     */
    public function getAirponClients(): Collection
    {
        return $this->airponClients;
    }

    public function addAirponClient(AirponClient $airponClient): static
    {
        if (!$this->airponClients->contains($airponClient)) {
            $this->airponClients->add($airponClient);
            $airponClient->setModemOnt($this);
        }

        return $this;
    }

    public function removeAirponClient(AirponClient $airponClient): static
    {
        if ($this->airponClients->removeElement($airponClient)) {
            // set the owning side to null (unless already changed)
            if ($airponClient->getModemOnt() === $this) {
                $airponClient->setModemOnt(null);
            }
        }

        return $this;
    }
}
