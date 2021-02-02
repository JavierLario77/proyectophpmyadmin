<?php

namespace App\Repository;

use App\Entity\Gamasproductos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gamasproductos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gamasproductos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gamasproductos[]    findAll()
 * @method Gamasproductos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GamasproductosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gamasproductos::class);
    }
    public function getAll()
    {
        $em = $this->getEntityManager();
        $sql =
            'Select c
            from App:gamasproductos c';
        $query = $em->createQuery($sql);
        $categorias = $query->getArrayResult();
        return $categorias;
    }
    public function newGama($gama,$descripcion){

        $em = $this->getEntityManager();
        $qb = $em->getConnection()->createQueryBuilder();

        $qb->insert('gamasproductos')
            ->values(array(
                'gama' => '?',
                'descripciontexto' => '?',

            ))
            ->setParameter(0, $gama)
            ->setParameter(1, $descripcion);


        return $qb->execute();
    }

    // /**
    //  * @return Gamasproductos[] Returns an array of Gamasproductos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gamasproductos
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
