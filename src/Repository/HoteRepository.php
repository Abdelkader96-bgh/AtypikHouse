<?php

namespace App\Repository;

use App\Entity\Base\Hote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hote[]    findAll()
 * @method Hote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hote::class);
    }

    // /**
    //  * @return Hote[] Returns an array of Hote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hote
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
