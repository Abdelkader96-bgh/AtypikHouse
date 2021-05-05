<?php

namespace App\Repository;

use App\Entity\Base\Cabane;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cabane|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cabane|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cabane[]    findAll()
 * @method Cabane[]    findAllVisible()
 * @method Cabane[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabaneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cabane::class);
    }

    public function findAllVisible()
    {
        return $this->findVisibleQuery()
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array
     */
    public function findLatest() :array
    {
        return $this->findVisibleQuery()
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }




    private function findVisibleQuery() :QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = false');
    }



    // /**
    //  * @return Cabane[] Returns an array of Cabane objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cabane
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
}
