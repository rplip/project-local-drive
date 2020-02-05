<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function searchShortCategory($searchInput)
    {
        return $this->createQueryBuilder('c')
                    //->join('c.products', 'p' )
                    ->Where("c.name LIKE :name")
                    //->orwhere("p.name LIKE :product")
                    ->setParameter('name', "%".$searchInput."%")
                    //->setParameter('product', "%".$searchInput."%")
                    ->getQuery()
                    ->getResult();
    }

}
