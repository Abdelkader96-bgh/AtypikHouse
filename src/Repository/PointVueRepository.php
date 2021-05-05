<?php

namespace App\Repository;

use App\Entity\Base\PointVue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PointVue|null find($id, $lockMode = null, $lockVersion = null)
 * @method PointVue|null findOneBy(array $criteria, array $orderBy = null)
 * @method PointVue[]    findAll()
 * @method PointVue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PointVueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PointVue::class);
    }

    // /**
    //  * @return PointVue[] Returns an array of PointVue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PointVue
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
