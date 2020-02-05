<?php

namespace App\Controller\Api\V1;

use App\Entity\Cart;
use App\Repository\CartRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api/v1/cart", name="api_v1_cart")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="cartList", methods={"GET"})
     */
    public function list(CartRepository $cartRepository, SerializerInterface $serializer)
    {
        $carts = $cartRepository->findAll();
        $data = $serializer->normalize($carts, null, ['groups' => 'api_v1']);

        return $this->json($data);
    }

    /**
     * @Route("/{id}", name="cartShow", methods={"GET"})
     */
    public function show(Cart $cart, SerializerInterface $serializer)
    {
        $data = $serializer->normalize($cart, null, ['groups' => ['api_v1', 'api_v1_detail']]);
        return $this->json($data);
    }
}
