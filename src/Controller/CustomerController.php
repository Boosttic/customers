<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Customer;
use App\Form\CustomerType;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class implementing interactions with customers
 * @author Joachim HANRAS-GRAFF <joachimhg@outlook.fr>
 * @author Matthieu PAYS <pays.matthieuic@gmail.com>
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
     * To display all customers
     * @return Response
     */
    #[Route('/', name: 'customers')]
    public function index(): Response
    {
        return  $this->render("customers/index.html.twig");
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
    #[Route('/customers', name: 'customer_create')]
    public function newCustomer(Request $request): Response
    {
        $customer = new Customer();
        $customer->setPostalAddress(new Address());
        return $this->renderCustomerForm($request, $customer);
    }

    /**
     * To edit a customer
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    #[Route('/customers/{id}', name: 'customer_update')]
    public function editCustomer(Request $request, Customer $customer): Response
    {
        return $this->renderCustomerForm($request, $customer);
    }

    /**
     * To create a customer form
     * @param Request $request
     * @param Customer $customer
     * @return Response
     */
    private function renderCustomerForm(Request $request, Customer $customer): Response
    {
        $form = $this->createForm(CustomerType::class, $customer);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            foreach($customer->getContacts() as $contact)
            {
                $contact->setCustomer($customer);
            }
            $this->em->persist($customer);
            $this->em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('customers/form.html.twig', [
            'customer' => $customer,
            'form' => $form->createView()
        ]);
    }
    
}