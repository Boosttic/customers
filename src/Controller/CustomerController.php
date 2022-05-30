<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 

class CustomerController extends AbstractController
{
    /**
     *@Route("/home")
     */
    /*public function client(ManagerRegistry $doctrine)
    {
       $customer= new Customer();
       $customer->setName('Client_A');
       $entityManager = $doctrine->getManager();
       $entityManager->persist($customer);
       $entityManager->flush();
     
    }*/
}

?>