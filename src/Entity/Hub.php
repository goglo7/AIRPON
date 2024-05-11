<?php

namespace App\Entity;

use App\Repository\HubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HubRepository::class)]
class Hub
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gps = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $positionHubOlt = null;

    /**
     * @var Collection<int, ReceptionHub>
     */
    #[ORM\OneToMany(targetEntity: ReceptionHub::class, mappedBy: 'hub')]
    private Collection $receptionHubs;

    /**
     * @var Collection<int, CableHubBox>
     */
    #[ORM\OneToMany(targetEntity: CableHubBox::class, mappedBy: 'hub')]
    private Collection $cableHubBoxes;

    public function __construct()
    {
        $this->receptionHubs = new ArrayCollection();
        $this->cableHubBoxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPositionHubOlt(): ?string
    {
        return $this->positionHubOlt;
    }

    public function setPositionHubOlt(string $positionHubOlt): static
    {
        $this->positionHubOlt = $positionHubOlt;

        return $this;
    }

    /**
     * @return Collection<int, ReceptionHub>
     */
    public function getReceptionHubs(): Collection
    {
        return $this->receptionHubs;
    }

    public function addReceptionHub(ReceptionHub $receptionHub): static
    {
        if (!$this->receptionHubs->contains($receptionHub)) {
            $this->receptionHubs->add($receptionHub);
            $receptionHub->setHub($this);
        }

        return $this;
    }

    public function removeReceptionHub(ReceptionHub $receptionHub): static
    {
        if ($this->receptionHubs->removeElement($receptionHub)) {
            // set the owning side to null (unless already changed)
            if ($receptionHub->getHub() === $this) {
                $receptionHub->setHub(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CableHubBox>
     */
    public function getCableHubBoxes(): Collection
    {
        return $this->cableHubBoxes;
    }

    public function addCableHubBox(CableHubBox $cableHubBox): static
    {
        if (!$this->cableHubBoxes->contains($cableHubBox)) {
            $this->cableHubBoxes->add($cableHubBox);
            $cableHubBox->setHub($this);
        }

        return $this;
    }

    public function removeCableHubBox(CableHubBox $cableHubBox): static
    {
        if ($this->cableHubBoxes->removeElement($cableHubBox)) {
            // set the owning side to null (unless already changed)
            if ($cableHubBox->getHub() === $this) {
                $cableHubBox->setHub(null);
            }
        }

        return $this;
    }
}
