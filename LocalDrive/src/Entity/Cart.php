<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("api_v1")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Groups("api_v1")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="carts")
     * @Groups("api_v1_detail")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="carts")
     * @Groups("api_v1")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->quantity;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
