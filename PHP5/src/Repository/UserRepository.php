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

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByNameOrEmailOrBirthday($name, $email, $birthday) {
        $qb = $this->createQueryBuilder('u');
        $qb->select('u')
            ->where('u.name LIKE :name')
            ->orWhere('u.email = :email')
            ->orWhere('u.birthday <= :birthday')
            ->setParameter('name', $name.'%')
            ->setParameter('email', $email)
            ->setParameter('birthday', $birthday)
        ;
        $query = $qb->getQuery();

        return $query->getResult();
    }
    public function countUsers() {
        $qb = $this->createQueryBuilder('u');
        $qb->select('COUNT(u)');
        $query = $qb->getQuery();
        // scalarResult : quand il n'y a qu'une seule colonne retournée par la requête
        // singleScalarResult : quand il n'y a qu'une seule colonne retournée et un seul enregistrement par la requête
        $nbUsers = $query->getSingleScalarResult();

        return $nbUsers;
    }
}
