<?php
 
namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use App\Entity\Customer;
use App\Repository\CustomerRepository;

class HomeController extends AbstractController
{
    
    /**
     *@Route("/")
     */
    public function index(ManagerRegistry $doctrine, CustomerRepository $customerRepository): Response
    {
       /* $contact = new Contact();
        $customer = new Customer();
        $customer->setName('Michel');
        $contact ->setName('Client_A')
        ->setEmail('clienta@gmail.com')
        ->setCustomer($customer);
        
        
        $entityManager = $doctrine->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();*/
        
       $customers = $repository = $customerRepository
            ->findAll();
        dump($repository);
        
        return $this->render("Pages/home.html.twig", ['customers'=> $customers]);
    }
}