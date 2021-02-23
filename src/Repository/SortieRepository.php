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

//        dd($search);
        $qb = $this
            ->createQueryBuilder('s')
            ->addSelect('e')
            ->Join('s.etat', 'e')
            ->addSelect('c')
            ->Join('s.campus', 'c');

        if(!empty($search->campus)) {

            $qb = $qb -> andWhere('c.nom LIKE :campus')
                ->setParameter('campus', '%' . $search->getCampus() . "%");
        }

        if(!empty($search->nomContient)) {
            $qb = $qb -> andWhere('s.nom LIKE :nom')
                ->setParameter('nom', '%' . $search->nomContient . "%");
        }

        if(!empty($search->getDateDebut() && !empty($search->getDateFin()))) {
            $qb = $qb ->andWhere('s.dateHeureDebut BETWEEN :dateDebut AND :dateFin ')
                ->setParameter('dateDebut', $search->getDateDebut())
                ->setParameter('dateFin', $search->getDateFin());
        }

        if($search->isOrganisateur()) {
            $qb = $qb
                ->andWhere('s.organisateur = :organisateur')
                ->setParameter('organisateur', "{$id}");
        }

        if($search->isInscrit()) {
            $qb = $qb
                ->andWhere(':participant MEMBER OF s.participants')
                ->setParameter('participant', "{$id}");
        }

        if($search->isPasInscrit()) {
            $qb = $qb
                ->andWhere(':participant NOT MEMBER OF s.participants')
                ->setParameter('participant', "{$id}");
        }

        if($search->isSortiesPassees()) {
            $qb = $qb
                ->andWhere(':date > s.dateHeureDebut')
                ->setParameter('date', $date);
        }


        return $qb;

    }


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
