<?php

namespace App\Repository;

use App\Entity\Imdbmovies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Imdbmovies>
 *
 * @method Imdbmovies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imdbmovies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imdbmovies[]    findAll()
 * @method Imdbmovies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImdbmoviesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imdbmovies::class);
    }

//    /**
//     * @return Imdbmovies[] Returns an array of Imdbmovies objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Imdbmovies
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
