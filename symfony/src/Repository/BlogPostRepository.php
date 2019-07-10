<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BlogPost|null find($id, $lockMode = null, $lockVersion = null)
 * @method BlogPost|null findOneBy(array $criteria, array $orderBy = null)
 * @method BlogPost[]    findAll()
 * @method BlogPost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BlogPostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BlogPost::class);
    }

    public function searchByTitle(string $title)
    {
        return $this->createQueryBuilder('p')
            ->where('p.title LIKE :title')
            ->setParameter('title', $title)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string|null $term
     * @return QueryBuilder
     */
    public function getWithSearchQueryBuilder(?string $term): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p');

        if ($term)
        {
            $qb->andWhere('p.title LIKE :term')
                ->setParameter('term', '%'.$term.'%');
            ;
        }

        return $qb;

    }

    // /**
    //  * @return BlogPost[] Returns an array of BlogPost objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BlogPost
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
