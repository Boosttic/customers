<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Contact;

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
            ->leftJoin('c.contacts', 'm')
            ->andWhere('m.main=1')
            ->orderby('m.main', 'ASC')
            ->getQuery()
            ->getResult();
    }
    
    public function findById($id)
    {
        return $this->createQueryBuilder('c')
            ->addSelect('contacts')
            ->addSelect('products')
            ->addSelect('server')
            ->addSelect('dB')
            ->addSelect('accounts')
            ->addSelect('application')
            ->addSelect('port')
            ->leftJoin('c.contacts', 'contacts')
            ->leftJoin('c.products', 'products')
            ->leftJoin('products.server', 'server')
            ->leftJoin('server.dB', 'dB')
            ->leftJoin('server.accounts', 'accounts')
            ->leftJoin('server.application', 'application')
            ->leftJoin('application.port', 'port')
            ->where('c.id=:id')
            ->setParameter('id', $id)
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
