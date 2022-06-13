<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function add(Customer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Customer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findCustomerByMain()
    {
        return $this->createQueryBuilder('c')
            ->addSelect('m')
            ->leftJoin('c.contact', 'm')
            ->andWhere('m.is_main=1')
            ->getQuery()
            ->getResult();
    }

    public function findById($id)
    {
        return $this->createQueryBuilder('c')
            ->addSelect('contact')
            ->addSelect('products')
            ->addSelect('machine')
            ->addSelect('accounts')
            ->addSelect('applications')
            ->addSelect('sale')
            ->addSelect('provider')
            ->addSelect('providerOffers')
            ->leftJoin('c.contact', 'contact')
            ->leftJoin('c.sale', 'sale')
            ->leftJoin('sale.machine', 'machine')
            ->leftJoin('machine.products', 'products')
            ->leftjoin('machine.applications', 'applications')
            ->leftJoin('machine.accounts', 'accounts')
            ->leftJoin('machine.provider', 'provider')
            ->leftJoin('provider.providerOffers', 'providerOffers')
            ->where('c.id=:id')
            ->setParameter('id', $id)
            ->orderby('contact.is_main', 'DESC')
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Customer[] Returns an array of Customer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Customer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
