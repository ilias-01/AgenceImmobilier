<?php

namespace App\Repository;

use App\Entity\PropertyLike;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PropertyLike|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyLike|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyLike[]    findAll()
 * @method PropertyLike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyLikeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropertyLike::class);
    }

    // /**
    //  * @return PropertyLike[] Returns an array of PropertyLike objects
    //  */
    
    public function findByUser($id_user)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.user_id = :val')
            ->setParameter('val', $id_user)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?PropertyLike
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
