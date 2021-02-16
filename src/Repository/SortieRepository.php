<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Sortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sortie[]    findAll()
 * @method Sortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sortie::class);
    }

    public function recherche(SearchData $search, $id, $date)
    {
        $qb = $this
            ->createQueryBuilder('s')
            ->addSelect('e')
            ->join('e', 's.etat_id');
        $qb->addSelect('c')
            ->join('c', 's.campus_id');

        if(!empty($search->getCampus())) {
            $qb = $qb -> andWhere('c.nom = :campus')
                ->setParameter('campus', "{$search->getCampus()}");
        }

    }


    // /**
    //  * @return Sortie[] Returns an array of Sortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


//    public function findSearch(SearchData $search)
//    {
//        $qb = $this
//            ->createQueryBuilder('i')
//            ->addSelect('c')
//            ->join('i.category', 'c');
//
//        if (!empty($search->q)) {
//            $qb = $qb
//                ->andWhere('i.author LIKE :q')
//                ->setParameter('q', '%' . $search->q . '%');
//        }
//
//        return $qb;
//    }

    /*
    public function findOneBySomeField($value): ?Sortie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
