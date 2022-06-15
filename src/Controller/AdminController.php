<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Contact;
use App\Entity\Product;
use App\Repository\CustomerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CustomerformType;
use App\Form\ProductType;
use App\Form\MachineType;

class AdminController extends AbstractController
{

    /**
     * @Route("/createCustomer", name="page_creation_client")
     */
    public function newCustomer(Request $request, ManagerRegistry $doctrine): Response
    {
        $customer = new Customer();
        $form = $this->createForm(CustomerformType::class, $customer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            foreach ($customer->getContacts() as $contact)
            {
                $contact->setCustomer($customer);
            }
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->renderForm('Pages/Admin/creationclient.html.twig', ['form' => $form]);
    }

    /**
     * @Route("/createProduct", name="page_creation_produit")
     */
    public function newPorduct(Request $request, ManagerRegistry $doctrine): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->renderForm('Pages/Admin/creationproduit.html.twig', ['form'=>$form]);
    }

}