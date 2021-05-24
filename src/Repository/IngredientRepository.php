<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Ingredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingredient[]    findAll()
 * @method Ingredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientRepository extends ServiceEntityRepository
{

     /**
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Ingredient::class);
        $this->paginator = $paginator;
    }

    /**
     * @return Ingredient[]
     */
    public function findLatest(): array
    {
        return $this->createQueryBuilder('i')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Ingredient[]
     */
    public function typeSearch(): array
    {
        return $this->findAll();
    }

    /**
     * @return PaginationInterface
     */
    public function findSearch(SearchData $search): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('i')
            ->select('c','i')
            ->join('i.categoryIngredient', 'c');
        

        if(!empty($search->q)) {
            $query = $query
                ->andWhere('i.name LIKE :q')
                ->setParameter('q', "%{$search->q}%");
        }

        if(!empty($search->categoryIngredient)) {
            $query = $query
                ->andWhere('c.id IN (:categoryIng)')
                ->setParameter('categoryIng', $search->categoryIngredient );
        }

        $query = $query->getQuery();
        return $this->paginator->paginate(
            $query,
            $search->page,
            5
        );
    }



    // /**
    //  * @return Ingredient[] Returns an array of Ingredient objects
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
    public function findOneBySomeField($value): ?Ingredient
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
