<?php

namespace App\Repository;

use App\Entity\CategoryIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryIngredient[]    findAll()
 * @method CategoryIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryIngredient::class);
    }

    // /**
    //  * @return CategoryIngredient[] Returns an array of CategoryIngredient objects
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
    public function findOneBySomeField($value): ?CategoryIngredient
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
