<?php

namespace App\Repository;

use App\Entity\BlogPost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function findOrdered($limit = 30)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.pubDate', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $limit
     * @return BlogPost[]
     */
    public function finNotPublished($limit = 30)
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.pubDate', 'DESC')
            ->where('b.edition IS NULL')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
            ;
    }
}
