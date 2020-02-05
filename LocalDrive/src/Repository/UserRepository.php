<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function searchIfMailIsHere($mailInput, $passwordInput)
    {
        
        $check = $this->createQueryBuilder('u')
        ->Where("u.email LIKE :email")
        ->setParameter('email', "$mailInput")
        ->getQuery()
        ->getResult();

        if(!empty($check)){
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
        $check = $this->createQueryBuilder('u')
        ->Where("u.email LIKE :email")
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
