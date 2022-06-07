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

class CustomerController extends AbstractController
{
    
    /**
     * @Route("/customer/{id}", name="page_customer")
     */
    
    public function InfoClient(string $id, ManagerRegistry $doctrine, CustomerRepository $customerRepository): Response
    { 
       $customer = $customerRepository->findById($id); 
        
        return $this->render("Pages/customer.html.twig",['customer'=>$customer]);
    }
    
}
