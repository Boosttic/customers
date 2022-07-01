<?php
 
namespace App\Controller;

use App\Entity\Contact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Repository\ContactRepository;

/**
 * @author Joachim Hanras-Graff <joachimhg@outlook.fr>
 */
class HomeController extends AbstractController
{
    
    /**
     * To display the home page
     * @param ManagerRegistry $doctrine
     * @param CustomerRepository $customerRepository
     * @return Response
     *@Route("/", name="home")
     */
    public function index(ManagerRegistry $doctrine, CustomerRepository $customerRepository): Response
    {   
       $customers = $repository = $customerRepository
            ->findCustomerByMain();
        
        return $this->render("Pages/home.html.twig", ['customers'=> $customers]);
    }
}