<?php

namespace App\Repository;

use App\Entity\Twit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Twit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Twit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Twit[]    findAll()
 * @method Twit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TwitRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Twit::class);
    }

    // /**
    //  * @return Twit[] Returns an array of Twit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Twit
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
