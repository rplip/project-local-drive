<?php

namespace App\Controller\Api\V1;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
* @Route("/api/v1/category", name="api_v1_category")
*/
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="categoryList", methods={"GET"})
     */
    public function list(CategoryRepository $categoryRepository, SerializerInterface $serializer)
    {

        $category = $categoryRepository->findAll();
        $data = $serializer->normalize($category, null, ['groups' => 'api_v1']);

        return $this->json($data);
    }

    /**
     * @Route("/search", name="categorySearch", methods={"POST"})
     */
    public function search(CategoryRepository $categoryRepository, Request $request, SerializerInterface $serializer)
    {
        $parametersAsArray = [];
        $content = $request->getContent();
        $parametersAsArray = json_decode($content, true);
        //Récupère l'input de la barre de recherche qui s'appelle categoryValue
        $searchInput = $parametersAsArray['categoryValue'];
        //Passe cet input par la methode searchSortShop du ShopRepository
        $categoriesSearch = $categoryRepository->searchShortCategory($searchInput);
        //Serialise la réponse
        $data = $serializer->normalize($categoriesSearch, null, ['groups' => ['api_v1_search']]);
        //Renvoi du json
        return $this->json($data);
    }

    /**
     *@Route("/{id}", name="categoryShow", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Category $category, SerializerInterface $serializer)
    {
        
        $data = $serializer->normalize($category, null, ['groups' => ['api_v1']]);
        return $this->json($data);
    }
}
