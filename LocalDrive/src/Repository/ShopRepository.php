<?php

namespace App\Repository;

use App\Entity\Shop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Shop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shop[]    findAll()
 * @method Shop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShopRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shop::class);
    }

    public function searchSortShop($searchInput)
    {
        return $this->createQueryBuilder('s')
                    ->Where("s.city LIKE :city")
                    ->setParameter('city', "%".$searchInput."%")
                    ->getQuery()
                    ->getResult();
    }

    public function searchIfMailIsHere($mailInput, $passwordInput)
    {
        $check = $this->createQueryBuilder('s')
        ->Where("s.email LIKE :email")
        ->setParameter('email', "$mailInput")
        ->getQuery()
        ->getResult();

        if (!empty($check)) {
            $hash = $check[0]->getPassword();

            if (password_verify($passwordInput, $hash)) {
                return $check;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkMail($inputMail)
    {
        $check = $this->createQueryBuilder('s')
        ->Where("s.email LIKE :email")
        ->setParameter('email', "$inputMail")
        ->getQuery()
        ->getResult();

        if (!empty($check)) {
            return true;
        } else {
            return false;
        }

    }

}
