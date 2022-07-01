<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Joachim Hanras-Graff <joachimhg@outlook.fr>
 */
class CustomerController extends AbstractController
{
    
    /**
     * To display the customer page
     * @param string $id
     * @param ManagerRegistry $doctrine
     * @CustomerRepository $customerRepository
     * @return Response
     * @Route("/customer/{id}", name="page_customer")
     */
    public function InfoClient(string $id, ManagerRegistry $doctrine, CustomerRepository $customerRepository): Response
    { 
       $customer = $customerRepository->findById($id); 
        
        return $this->render("Pages/customer.html.twig",['customer'=>$customer]);
    }
    
}
