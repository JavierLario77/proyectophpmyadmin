<?php

namespace App\Repository;

use App\Entity\Productos;
use App\Entity\Gamasproductos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Productos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Productos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Productos[]    findAll()
 * @method Productos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Productos::class);
    }
    public function getAll($gama){
        $em = $this->getEntityManager();
        $sql =
            'Select p.nombre,p.descripcion,p.precioventa,p.codigoproducto
             from App:productos p
             JOIN p.gama c
             WHERE c.gama=:gama';
        $query = $em->createQuery($sql)
            ->setParameter('gama',$gama);
        $productos = $query->getArrayResult();
        
        return $productos;
    }
    public function getDetalles($codigo){
        $em = $this->getEntityManager();
        $sql =
            'Select p
             from App:productos p
             WHERE p.codigoproducto=:codigoP';
        $query = $em->createQuery($sql)
            ->setParameter('codigoP',$codigo);
        $productos = $query->getArrayResult();
        return $productos;
    }
    public function newProducto($codigo, $nombre, $gama, $dimensiones, $proveedor, $descripcion, $cantidadstock, $preciov, $preciop){

        $em = $this->getEntityManager();
        $qb = $em->getConnection()->createQueryBuilder();

        $qb->insert('productos')
            ->values(array(
                'codigoproducto' => '?',
                'nombre' => '?',
                'gama' => '?',
                'dimensiones' => '?',
                'proveedor' => '?',
                'descripcion' => '?',
                'cantidadenstock' => '?',
                'precioventa' => '?',
                'precioproveedor' => '?'

            ))
            ->setParameter(0, $codigo)
            ->setParameter(1, $nombre)
            ->setParameter(2, $gama)
            ->setParameter(3, $dimensiones)
            ->setParameter(4, $proveedor)
            ->setParameter(5, $descripcion)
            ->setParameter(6, $cantidadstock)
            ->setParameter(7, $preciov)
            ->setParameter(8, $preciop);


        return $qb->execute();
    }

    // /**
    //  * @return Productos[] Returns an array of Productos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Productos
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
