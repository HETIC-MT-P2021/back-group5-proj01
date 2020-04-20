<?php

namespace App\Repository;

use App\Entity\AssocTagsImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AssocTagsImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssocTagsImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssocTagsImages[]    findAll()
 * @method AssocTagsImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssocTagsImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AssocTagsImages::class);
    }

    // /**
    //  * @return AssocTagsImages[] Returns an array of AssocTagsImages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AssocTagsImages
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
