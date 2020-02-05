<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function searchSortProduct($searchInput)
    {
        return $this->createQueryBuilder('p')
                    ->join('p.shop', 's')
                    ->join('p.category', 'c')
                    ->where("p.name LIKE :name")
                    ->orWhere("s.name LIKE :shop")
                    ->orWhere("s.city LIKE :shop")
                    ->orWhere("s.job LIKE :shop")
                    ->orWhere("c.name LIKE :category")
                    ->setParameter('name', "%".$searchInput."%")
                    ->setParameter('shop', "%".$searchInput."%")
                    ->setParameter('category', "%".$searchInput."%")
                    ->getQuery()
                    ->getResult();
    }

    public function productOnSale ($shopId)
    {
        return $this->createQueryBuilder('p')
        ->join ('p.shop', 's')
        ->where("p.sale NOT LIKE :sale")
        ->andWhere("s.id LIKE :id")
        ->setParameter('sale', "null")
        ->setParameter('id', $shopId)
        ->getQuery()
        ->getResult();
    }

}
