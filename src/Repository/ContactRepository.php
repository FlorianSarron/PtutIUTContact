<?php

namespace App\Repository;

use App\Entity\Contact;
use App\Data\SearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    // /**
    //  * @return Product[]
    //  */
    public function findSearch(SearchData $search)
    {
    /*$query = $this
        ->createQueryBuilder('p')
        ->select('c', 'p')
        ->join('p.categories', 'c');

    if (!empty($search->q)) {
        $query = $query
            ->andWhere('p.name LIKE :q')
            ->setParameter('q', "%{$search->q}%");
    }

    if (!empty($search->min)) {
        $query = $query
            ->andWhere('p.price >= :min')
            ->setParameter('min', $search->min);
    }

    if (!empty($search->max)) {
        $query = $query
            ->andWhere('p.price <= :max')
            ->setParameter('max', $search->max);
    }

    if (!empty($search->promo)) {
        $query = $query
            ->andWhere('p.promo = 1');
    }

    if (!empty($search->categories)) {
        $query = $query
            ->andWhere('c.id IN (:categories)')
            ->setParameter('categories', $search->categories);
    }

    return $this->paginator->paginate(
        $query,
        $search->page,
        9
    );*/
        return $this->findAll(); 
    }
    // /**
    //  * @return Contact[] Returns an array of Contact objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contact
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
