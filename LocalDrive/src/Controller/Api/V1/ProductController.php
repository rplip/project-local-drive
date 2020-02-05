<?php

namespace App\Controller\Api\V1;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\ShopRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/api/v1/product", name="api_v1_product")
*/
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="productList", methods={"GET"})
     */
    public function list(ProductRepository $productRepository, SerializerInterface $serializer)
    {
        //On recupère l'ensemble des produits
        $products = $productRepository->findAll();
        $data = $serializer->normalize($products, null, ['groups' => 'api_v1']);
        return $this->json($data);
    }

    /**
     * @Route("/search", name="productSearch", methods={"POST"})
     */
    public function search(ProductRepository $productRepository, Request $request, SerializerInterface $serializer)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        //Récupère l'input de la barre de recherche qui s'appelle productValue
        $searchInput = $parametersAsArray['productValue'];
        //Passe cet input par la methode searchSortShop du ProductRepository
        $productsSearch = $productRepository->searchSortProduct($searchInput);
        //Serialise la réponse
        $data = $serializer->normalize($productsSearch, null, ['groups' => ['api_v1_search']]);
        //Renvoi du json
        return $this->json($data);
    }

    /** 
     *@Route("/add", name="productAdd", methods={"POST"})
     *
     */
    public function add(CategoryRepository $cr, Request $request,SerializerInterface $serializer, ShopRepository $sr)
    {
        
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

        $inputIdShop = $parametersAsArray['shopId'];
        $inputIdCategory = $parametersAsArray['categoryId'];
        $inputName = $parametersAsArray['name'];
        $inputImage = $parametersAsArray['image'];
        $inputPrice = $parametersAsArray['price'];
        $inputSale= $parametersAsArray['sale'];
        $inputDescription = $parametersAsArray['description'];
        $inputUnit= $parametersAsArray['unit'];
        $inpuStock= $parametersAsArray['stock'];
        // On cherche le shop et la catégorie correspondant à l'id reçue
        $shopId = $sr->find($inputIdShop);
        $categoryId = $cr->find($inputIdCategory);

        $em = $this->getDoctrine()->getManager();

        $product = new Product;
        $product->setShop($shopId);
        $product->setCategory($categoryId);
        $product->setName($inputName);
        $product->setImage($inputImage);
        $product->setPrice($inputPrice);
        $product->setSale($inputSale);
        $product->setDescription($inputDescription);
        $product->setUnit($inputUnit);
        $product->setStock($inpuStock);
        $product->setCreatedAt(new \DateTime);

        $em->persist($product);
        $em->flush();

        $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);

        return $this->json($data);
        
    }

    /**
     * @Route("/{id}/update", name="productUpdate", methods={"PUT"})
     * 
     */
    public function update(int $id, CategoryRepository $cr, ProductRepository $pr, Request $request, SerializerInterface $serializer)
    {

        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);

    
        $inputIdSHop = $parametersAsArray['shopId'];
        $inputIdCategory = $parametersAsArray['categoryId'];
        $inputName = $parametersAsArray['name'];
        $inputImage = $parametersAsArray['image'];
        $inputPrice = $parametersAsArray['price'];
        $inputDescription = $parametersAsArray['description'];
        $inputUnit= $parametersAsArray['unit'];
        $inpuStock= $parametersAsArray['stock'];

        $product = $pr->find($id);
        $categoryId = $cr->find($inputIdCategory);

        $em = $this->getDoctrine()->getManager();

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for'.$inputName
            );
        }

        $product->setCategory($categoryId);
        $product->setName($inputName);
        $product->setImage($inputImage);
        $product->setPrice($inputPrice);
        $product->setDescription($inputDescription);
        $product->setUnit($inputUnit);
        $product->setStock($inpuStock);
        $product->setupdatedAt(new \DateTime);

        $em->persist($product);
        $em->flush();

        $data = $serializer->normalize($product, null, ['groups' => 'api_v1_product']);

        return $this->json($data);
    }

    /**
     * @Route("/{id}/upload-image", name="uploadImageProduct", methods={"POST"})
     */
    public function uploadImage(int $id, ProductRepository $pr, Request $request, SerializerInterface $serializer)
    {
        //On recupère le fichier qui a pour value 'image'
        $image = $request->files->get('image');
        //On crée un nom unique et on ajoute la même extension que le fichier d'origine
        $imageName = md5(uniqid()).'.'.$image->guessExtension();
        //On envoi ledit fichier dans le dossier /public/images/products avec sno nom unique
        $image->move($this->getParameter('upload_image_product'), $imageName);

        $em = $this->getDoctrine()->getManager();
        $product = $pr->find($id);
        $product->setImage($imageName);
        $em->persist($product);
        $em->flush();

        $data = $serializer->normalize($product, null, ['groups' => 'api_v1_image']);
        return $this->json($data);

    }


    /**
     * @Route("/{id}", name="productShow", methods={"GET"})
     */
    public function show(Product $product, SerializerInterface $serializer)
    {
        //Liste de tout les produits
        $data = $serializer->normalize($product, null, ['groups' => ['api_v1', 'api_v1_categories', 'api_v1_cart']]);
        
        return $this->json($data);
    }

      /**
     * @Route("/{id}/delete", name="productDelete", methods={"DELETE"})
     * 
     */

    public function delete(int $id, Request $request, SerializerInterface $serializer, ProductRepository $pr)
    {
        //Suppression d'un produit
        $product = $pr->find($id);

        $em = $this->getDoctrine()->getManager();

        if (!$product) {
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        
        $em->remove($product);
        $em->flush();

        return $this->json(true);
      
    }





}
