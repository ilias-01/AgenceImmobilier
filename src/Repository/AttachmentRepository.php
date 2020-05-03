<?php

namespace App\Repository;

use App\Entity\Attachment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attachment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attachment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attachment[]    findAll()
 * @method Attachment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attachment::class);
    }

    // /**
    //  * @return Attachment[] Returns an array of Attachment objects
    //  */
    // Non Utilisé !
    // public function findByProperties(array $properties):array
    // {
    //     $attachments=[];
    //     foreach($properties as $property){
    //         $tab= $this->createQueryBuilder('a')
    //                             ->andWhere('a.property = :val')
    //                             ->setParameter('val', $property->getId())
    //                             ->getQuery()
    //                             ->getResult();
    //         if($tab) $attachments[]=$tab;
    //     }
    //     return $attachments
    //     ;
    // }
    
    // private function queryBuilder(): 
    // {
    //     return $this->createQueryBuilder('a');
    // }
    /*
    public function findOneBySomeField($value): ?Attachment
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
