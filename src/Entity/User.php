<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(length: 255)]
    private ?string $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $matricule = null;

    #[ORM\Column(length: 255)]
    private ?string $postTravail = null;

    #[ORM\Column(length: 255)]
    private ?string $adressePersonelle = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseProfessionelle = null;

    #[ORM\Column(length: 255)]
    private ?string $telFixe = null;

    #[ORM\Column(length: 255)]
    private ?string $telPortable = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Direction $direction = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * The public representation of the user (e.g. a username, an email address, etc.)
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): static
    {
        $this->cin = $cin;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): static
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getPostTravail(): ?string
    {
        return $this->postTravail;
    }

    public function setPostTravail(string $postTravail): static
    {
        $this->postTravail = $postTravail;

        return $this;
    }

    public function getAdressePersonelle(): ?string
    {
        return $this->adressePersonelle;
    }

    public function setAdressePersonelle(string $adressePersonelle): static
    {
        $this->adressePersonelle = $adressePersonelle;

        return $this;
    }

    public function getAdresseProfessionelle(): ?string
    {
        return $this->adresseProfessionelle;
    }

    public function setAdresseProfessionelle(string $adresseProfessionelle): static
    {
        $this->adresseProfessionelle = $adresseProfessionelle;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->telFixe;
    }

    public function setTelFixe(string $telFixe): static
    {
        $this->telFixe = $telFixe;

        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->telPortable;
    }

    public function setTelPortable(string $telPortable): static
    {
        $this->telPortable = $telPortable;

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

    public function getRole(): string
    {
        if (in_array(UserRole::ADMIN->value, $this->getRoles())) {
            return UserRole::ADMIN->value;
        } else if (in_array(UserRole::CLIENTELE->value, $this->getRoles())) {
            return UserRole::CLIENTELE->value;
        } else if (in_array(UserRole::RESPONSABLE->value, $this->getRoles())) {
            return UserRole::RESPONSABLE->value;
        } else {
            return "ROLE_USER";
        }
    }
}