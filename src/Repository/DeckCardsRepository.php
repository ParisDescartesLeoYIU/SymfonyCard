<?php

namespace App\Repository;

use App\Entity\DeckCards;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DeckCards|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeckCards|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeckCards[]    findAll()
 * @method DeckCards[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeckCardsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeckCards::class);
    }

    // /**
    //  * @return DeckCards[] Returns an array of DeckCards objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeckCards
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
