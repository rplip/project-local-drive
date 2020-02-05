<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("api_v1_product")
     * @Groups("api_v1_image")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("api_v1")
     * @Groups("api_v1_search")
     * @Groups("api_v1_product")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_product")
     * @Groups("api_v1_image")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_product")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("api_v1_product")
     * @Groups("api_v1_productByShop")
     */
    private $sale;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("api_v1")
     * @Groups("api_v1_product")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=64)
     * @Groups("api_v1")
     * @Groups("api_v1_product")
     */
    private $unit;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("api_v1")
     * @Groups("api_v1_product")
     */
    private $stock;

    /**
     * @ORM\Column(type="datetime")
     * @Groups("api_v1")
     * @Groups("api_v1_product")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("api_v1_product")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop", inversedBy="products")
     * @Groups("api_v1_categories")
     * @Groups("api_v1_search")
     * @Groups("api_v1_product")
     */
    private $shop;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     * @Groups("api_v1_categories")
     * @Groups("api_v1_search")
     * @Groups("api_v1_product")
     * @Groups("api_v1_categoryByProduct")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Cart", mappedBy="product", orphanRemoval=true)
     */
    private $carts;



    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->carts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        if(!empty($price)) {
        $this->price = $price;
        }
        return $this;
    }

    public function getSale()
    {
        return $this->sale;
    }

    public function setSale($sale)
    {
        
        $this->sale = $sale;
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

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): self
    {
        if(!empty($unit)) {
        $this->unit = $unit;
        }
        return $this;
    }

    public function getStock(): ?string
    {
        return $this->stock;
    }

    public function setStock(string $stock): self
    {
        if(!empty($stock)) {
        $this->stock = $stock;
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

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        if(!empty($category)) {
        $this->category = $category;
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
            $cart->setProduct($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): self
    {
        if ($this->carts->contains($cart)) {
            $this->carts->removeElement($cart);
            // set the owning side to null (unless already changed)
            if ($cart->getProduct() === $this) {
                $cart->setProduct(null);
            }
        }

        return $this;
    }
    
}
