<?php

namespace App\Controller\Api\V1;

use App\Entity\Shop;
use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\IsNull;

/**
 * @Route("/api/v1/shop", name="api_v1_shop")
 */
class ShopController extends AbstractController
{
    /**
     * @Route("/", name="shopList", methods={"GET"})
     */
    public function list(ShopRepository $shopRepository, SerializerInterface $serializer)
    {
        //On liste tout les magasins
        $shops = $shopRepository->findAll();
        $data = $serializer->normalize($shops, null, ['groups' => 'api_v1']);

        return $this->json($data);
    }

    

    /**
     * @Route("/sale/update", name="shopSaleUpdate", methods={"PUT"})
     * 
     */
    public function saleUpdate(ProductRepository $pr, Request $request, SerializerInterface $serializer)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

        //On recupère l'id du produit et l'input correspondant à la promotion
        $inputIdProduct = $parametersAsArray['productId'];
        $inputSale = $parametersAsArray['sale'];

        $product = $pr->find($inputIdProduct);

        $em = $this->getDoctrine()->getManager();

        $product->setSale($inputSale);
        $product->setupdatedAt(new \DateTime);

        $em->persist($product);
        $em->flush();

        $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);

        return $this->json($data);
    }

    /**
     * @Route("/sale/delete", name="shopSaleDelete", methods={"DELETE"})
     * 
     */
    public function saleDelete(ProductRepository $pr, Request $request, SerializerInterface $serializer)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

        $inputIdProduct = $parametersAsArray['productId'];
        $product = $pr->find($inputIdProduct);
        
        $em = $this->getDoctrine()->getManager();
        //On set la promotion à null ce qui permettra de l'effacer des onglets promotions
        $product->setSale(null);
        $product->setupdatedAt(new \DateTime);
        $em->persist($product);
        $em->flush();

        $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);
        return $this->json($data);
    }

    /**
     * @Route("/{id}", name="shopShow", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Shop $shop, SerializerInterface $serializer)
    {
        
        $data = $serializer->normalize($shop, null, ['groups' => ['api_v1', 'api_v1_productByShop', 'api_v1_categoryByProduct']]);
        return $this->json($data);
    }

    /**
     * @Route("/{id}/sale", name="shopSaleList", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function saleList(int $id, ProductRepository $pr, SerializerInterface $serializer)
    {
        //Affiche les produits en promotion par magasin
        $productOnSale = $pr->productOnSale($id);
        $data = $serializer->normalize($productOnSale, null, ['groups' => 'api_v1_product']);
        return $this->json($data);
    }

    /**
     * @Route("/{id}/update", name="shop", methods={"PUT"})
     * 
     */
    public function update(int $id, Request $request,SerializerInterface $serializer, ShopRepository $sr)
    {

        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

       
        $inputEmail = $parametersAsArray['email'];
        $inputName = $parametersAsArray['name'];
        $inputPhone = $parametersAsArray['phone'];
        $inputDescription = $parametersAsArray['description'];
        $inputImage = $parametersAsArray['image'];
        $inputNumber = $parametersAsArray['number'];
        $inputStreet = $parametersAsArray['street'];
        $inputZip = $parametersAsArray['zip'];
        $inputCity = $parametersAsArray['city'];


        $em = $this->getDoctrine()->getManager();
        $shop = $sr->find($id);

        if (!$shop) {
            throw $this->createNotFoundException(
                'No shop found for email'.$inputEmail
           
            );
        }

        $shop->setName($inputName);
        $shop->setDescription($inputDescription);
        $shop->setImage($inputImage);
        $shop->setNumber($inputNumber);        
        $shop->setStreet($inputStreet);
        $shop->setZip($inputZip);
        $shop->setCity($inputCity);
        $shop->setPhone($inputPhone);
        $shop->setUpdatedAt(New \DateTime);
        


        $em->persist($shop);
        $em->flush();

        $data = $serializer->normalize($shop, null, ['groups' => 'api_v1']);

        return $this->json($data);
    }

    /**
     * @Route("/{id}/upload-image", name="uploadImageShop", methods={"POST"})
     */
    public function uploadImage(int $id, ShopRepository $sr, Request $request, SerializerInterface $serializer)
    {
        $image = $request->files->get('image');
        $imageName = md5(uniqid()).'.'.$image->guessExtension();
        $image->move($this->getParameter('upload_image_shop'), $imageName);

        $em = $this->getDoctrine()->getManager();
        $shop = $sr->find($id);
        $shop->setImage($imageName);
        $em->persist($shop);
        $em->flush();

        $data = $serializer->normalize($shop, null, ['groups' => 'api_v1_image']);
        return $this->json($data);

    }

    /**
     * @Route("/search", name="shopSearch", methods={"POST"})
     */
    public function search(ShopRepository $shopRepository, Request $request, SerializerInterface $serializer)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        //Récupère l'input de la barre de recherche qui s'appelle villeValue
        $searchInput = $parametersAsArray['villeValue'];
        //Passe cet input par la methode searchSortShop du ShopRepository
        $shopsSearch = $shopRepository->searchSortShop($searchInput);
        //Serialise la réponse
        $data = $serializer->normalize($shopsSearch, null, ['groups' => ['api_v1_search']]);
        //Renvoi du json
        return $this->json($data);
    }

  


}
