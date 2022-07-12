<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Customer;
use App\Form\CustomerformType;
use App\Repository\CustomerRepository;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Joachim Hanras-Graff <joachimhg@outlook.fr>
 */
class CustomerController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    public function __construct(EntityManagerInterface $em, CustomerRepository $customerRepository)
    {
        $this->em = $em;
        $this->customerRepository = $customerRepository;
    }

    /**
     * To display the customer page
     * @param string $id
     * @return Response
     */
    #[Route('/customer/{id}', name: 'page_customer')]
    public function InfoClient(string $id): Response
    { 
       $customer = $this->customerRepository->findById($id);

       return $this->render("Pages/customer.html.twig",['customer'=>$customer]);
    }

    /**
     * To create a new customer
     * @param Request $request
     * @return Response
     */
    #[Route('/createCustomer', name: 'page_creation_client')]
    public function newCustomer(Request $request): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerformType::class, $customer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            foreach ($customer->getContacts() as $contact)
            {
                $contact->setCustomer($customer);
            }
            try {
                $this->em->persist($customer);
                $this->em->flush();
            } catch (ORMException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }

            return $this->redirectToRoute('home');
        }

        return $this->renderForm('Pages/Admin/creationclient.html.twig', ['form' => $form]);
    }

    /**
     * To edit a customer
     * @param string $id
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    #[Route('/editCustomer/{id}', name: 'page_edition_client')]
    public function editCustomer(string $id, Request $request, Customer $customer): Response
    {
        $repository = $this->customerRepository->findById($id);
        $form = $this->createForm(CustomerformType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            foreach($customer->getContacts() as $contact)
            {
                $contact->setCustomer($customer);
            }
            try {
                $this->em->persist($customer);
                $this->em->flush();
            } catch (ORMException $e) {
                echo 'Exception reçue : ',  $e->getMessage(), "\n";
            }

            return $this->redirectToRoute('home');
        }

        return $this->render('Pages/Admin/edit/edit_client.html.twig', ['repository'=>$repository, 'form'=>$form->createView()]);
    }
    
}
