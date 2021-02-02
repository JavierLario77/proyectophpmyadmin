<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Usuarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuarios[]    findAll()
 * @method Usuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }
    public function MaxId(){
        $em = $this->getEntityManager();
        $sql =
            'Select max(u.id)
             from App:Usuarios u';
        $query = $em->createQuery($sql);
        $max = $query->getSingleScalarResult();
        return $max;

    }

    public function new($login, $pass, $nombre, $rol,$foto){

    $id = $this->MaxId();
    $id = $id + 1;

    $em = $this->getEntityManager();
    $qb = $em->getConnection()->createQueryBuilder();

    $qb->insert('usuarios')
        ->values(array(
            'id' => '?',
            'login' => '?',
            'password' => '?',
            'nombre' => '?',
            'rol' => '?',
            'foto' => '?'
        ))
        ->setParameter(0, $id)
        ->setParameter(1, $login)
        ->setParameter(2, $pass)
        ->setParameter(3, $nombre)
        ->setParameter(4, $rol)
        ->setParameter(5, $foto);


    return $qb->execute();
    }




    // /**
    //  * @return Usuarios[] Returns an array of Usuarios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usuarios
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
