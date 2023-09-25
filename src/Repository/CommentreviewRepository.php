<?php

namespace App\Repository;

use App\Entity\Commentreview;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentreview>
 *
 * @method Commentreview|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentreview|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentreview[]    findAll()
 * @method Commentreview[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentreviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentreview::class);
    }

//    /**
//     * @return Commentreview[] Returns an array of Commentreview objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Commentreview
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
