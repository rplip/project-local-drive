<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("api_v1")
     * @Groups("login_search")
     * @Groups("api_v1_image")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $lastname;

    /**
     * @ORM\Column(type="json")
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("login_search")
     * @Groups("api_v1")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("login_search")
     * @Groups("api_v1")
     * @Groups("api_v1_image")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $city;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("api_v1")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("api_v1")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("api_v1")
     * @Groups("login_search")
     * @Groups("api_v1")
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cart", mappedBy="user", orphanRemoval=true)
     */
    private $carts;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("login_search")
     */
    private $isShop;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->carts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        if(!empty($firstname)) {
        $this->firstname = $firstname;
        }
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        if(!empty($description)) {
        $this->description = $description;
        }
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        if(!empty($image)) {
        $this->image = $image;
        }
        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        if(!empty($number)) {
        $this->number = $number;
        }
        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        if(!empty($street)) {
        $this->street = $street;
        }
        return $this;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        if(!empty($zip)) {
        $this->zip = $zip;
        }
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        if(!empty($city)) {
            $this->city = $city;
        } 

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
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
     * @see UserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        if(!empty($phone)) {
        $this->phone = $phone;
        }
        return $this;
    }

    /**
     * @return Collection|Cart[]
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): self
    {
        if (!$this->carts->contains($cart)) {
            $this->carts[] = $cart;
            $cart->setUser($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->contains($cart)) {
            $this->carts->removeElement($cart);
            // set the owning side to null (unless already changed)
            if ($cart->getUser() === $this) {
                $cart->setUser(null);
            }
        }

        return $this;
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
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsShop(): ?bool
    {
        return $this->isShop;
    }

    public function setIsShop(bool $isShop): self
    {
        $this->isShop = $isShop;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        if(!empty($lastname)) {
        $this->lastname = $lastname;
        }
        return $this;
    }


}
