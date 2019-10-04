<?php

namespace App\Repository;

use App\Entity\Iojfr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Iojfr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Iojfr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Iojfr[]    findAll()
 * @method Iojfr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IojfrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Iojfr::class);
    }

    // /**
    //  * @return Iojfr[] Returns an array of Iojfr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Iojfr
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
