<?php

namespace App\Entity;

use App\Repository\BoxRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoxRepository::class)]
class Box
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $gps = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeInterface $dateInstallation = null;

    #[ORM\ManyToOne(inversedBy: 'boxes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CType $cType = null;

    #[ORM\OneToOne(mappedBy: 'source1', cascade: ['persist', 'remove'])]
    private ?CableInterBox $cableInterBoxSrc1 = null;

    #[ORM\OneToOne(mappedBy: 'source2', cascade: ['persist', 'remove'])]
    private ?CableInterBox $cableInterBoxSrc2 = null;

    /**
     * @var Collection<int, AirponClient>
     */
    #[ORM\OneToMany(targetEntity: AirponClient::class, mappedBy: 'box')]
    private Collection $airponClients;

    public function __construct()
    {
        $this->airponClients = new ArrayCollection();
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

    public function getDateInstallation(): ?\DateTimeInterface
    {
        return $this->dateInstallation;
    }

    public function setDateInstallation(\DateTimeInterface $dateInstallation): static
    {
        $this->dateInstallation = $dateInstallation;

        return $this;
    }

    public function getCType(): ?CType
    {
        return $this->cType;
    }

    public function setCType(?CType $cType): static
    {
        $this->cType = $cType;

        return $this;
    }

    public function getCableInterBoxSrc1(): ?CableInterBox
    {
        return $this->cableInterBoxSrc1;
    }

    public function setCableInterBoxSrc1(CableInterBox $cableInterBoxSrc1): static
    {
        // set the owning side of the relation if necessary
        if ($cableInterBoxSrc1->getSource1() !== $this) {
            $cableInterBoxSrc1->setSource1($this);
        }

        $this->cableInterBoxSrc1 = $cableInterBoxSrc1;

        return $this;
    }

    public function getCableInterBoxSrc2(): ?CableInterBox
    {
        return $this->cableInterBoxSrc2;
    }

    public function setCableInterBoxSrc2(CableInterBox $cableInterBoxSrc2): static
    {
        // set the owning side of the relation if necessary
        if ($cableInterBoxSrc2->getSource2() !== $this) {
            $cableInterBoxSrc2->setSource2($this);
        }

        $this->cableInterBoxSrc2 = $cableInterBoxSrc2;

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
            $airponClient->setBox($this);
        }

        return $this;
    }

    public function removeAirponClient(AirponClient $airponClient): static
    {
        if ($this->airponClients->removeElement($airponClient)) {
            // set the owning side to null (unless already changed)
            if ($airponClient->getBox() === $this) {
                $airponClient->setBox(null);
            }
        }

        return $this;
    }
}
