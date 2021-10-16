<?php

namespace App\Repository;

use App\Entity\IngredientQuantityInRecipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IngredientQuantityInRecipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientQuantityInRecipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientQuantityInRecipe[]    findAll()
 * @method IngredientQuantityInRecipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientQuantityInRecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientQuantityInRecipe::class);
    }

    // /**
    //  * @return IngredientQuantityInRecipe[] Returns an array of IngredientQuantityInRecipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientQuantityInRecipe
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
