<?php

namespace App\Entity;

use App\Repository\TypeOltRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeOltRepository::class)]
class TypeOlt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Olt>
     */
    #[ORM\OneToMany(targetEntity: Olt::class, mappedBy: 'type')]
    private Collection $olts;

    public function __construct()
    {
        $this->olts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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
            $olt->setType($this);
        }

        return $this;
    }

    public function removeOlt(Olt $olt): static
    {
        if ($this->olts->removeElement($olt)) {
            // set the owning side to null (unless already changed)
            if ($olt->getType() === $this) {
                $olt->setType(null);
            }
        }

        return $this;
    }
}
