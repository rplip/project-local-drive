<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository")
 */
class Shop implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     * @Groups("api_v1_product")
     * @Groups("api_v1_image")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     * @Groups("api_v1_product")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $job;

    /**
     * @ORM\Column(type="string", length=128, unique=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     * @Groups("api_v1_image")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $zip;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("login_search")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     */
    private $rate;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("api_v1_search")
     * @Groups("api_v1")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("api_v1")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="shop", orphanRemoval=true)
     * @Groups("api_v1_productByShop")
     */
    private $products;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("login_search")
     */
    private $isShop;

    /**
     * @ORM\Column(type="json")
     * @Groups("api_v1")
     * @Groups("login_search")
     */
    private $roles = [];

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->products = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->email;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        if(!empty($name)) {
        $this->name = $name;
        }
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

    public function setStreet(?string $street): self
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

    public function setCity(?string $city): self
    {
        if(!empty($city)) {
        $this->city = $city;
        }
        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(string $rate): self
    {
        $this->rate = $rate;

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

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setShop($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getShop() === $this) {
                $product->setShop(null);
            }
        }

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
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

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_SHOP';

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

}
