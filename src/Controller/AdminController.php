<?php

namespace App\Controller;

use App\Entity\Customer;
use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\Machine;
use App\Entity\Account;
use App\Entity\Provider;
use App\Entity\ProviderOffer;
use App\Entity\Ram;
use App\Entity\Stockage;
use App\Entity\Sale;
use App\Entity\Application;
use App\Repository\CustomerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CustomerformType;
use App\Form\ProductType;
use App\Form\MachineType;
use App\Form\ProviderOfferType;
use App\Form\ProviderType;
use App\Form\SaleType;
use App\Form\ApplicationType;

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
    public function newProduct(Request $request, ManagerRegistry $doctrine): Response
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

    /**
     * @Route("/createMachine", name="page_creation_machine")
     */
    public function newMachine(Request $request, ManagerRegistry $doctrine): Response
    {
        $machine = new Machine();
        
        $accountUI = new Account();
        $accountUI->setType(3);
        $accountSSH = new Account();
        $accountSSH->setType(2);
        $machine->addAccount($accountUI)
             ->addAccount($accountSSH);

        $form = $this->createForm(MachineType::class, $machine);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($machine);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Pages/Admin/creationmachine.html.twig', ['form'=>$form->createView(), 'machine'=>$machine]);
    }

    /**
     * @Route("/createProviderOffer", name="page_creation_providerOffer")
     */
    public function newProviderOffer(Request $request, ManagerRegistry $doctrine): Response
    {
        $offer = new ProviderOffer();
        $form = $this->createForm(ProviderOfferType::class, $offer);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($offer);
            $entityManager->flush();

            return $this->redirectToRoute('home'); 
        }
        return $this->renderForm('Pages/admin/creationoffer.html.twig', ['form'=>$form]);
    }

     /**
     * @Route("/createProvider", name="page_creation_provider")
     */
     public function newProvider(Request $request, ManagerRegistry $doctrine): Response
     {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);

        $form->handleRequest($request);
         if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            foreach ($provider->getProviderOffers() as $offer)
            {
                $offer->setProvider($provider);
            }
            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirectToRoute('home'); 
        }
        return $this->renderForm('Pages/admin/creationprovider.html.twig', ['form'=>$form]);
     }

     /**
      * @Route("/createSale", name="page_creation_sale")
      */
     public function newSale(Request $request, ManagerRegistry $doctrine): Response
     {
        $sale = new Sale();

        $form = $this->createForm(SaleType::class, $sale);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            foreach($sale->getApplications() as $app)
            {
                $app->addSale($sale);
                foreach($app->getProduct() as $product)
                {
                    foreach($product->getMachines() as $machine)
                    {
                        $machine->setProduct($product);
                    }
                }
            }
            $entityManager->persist($sale);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Pages/Admin/creationsale.html.twig', ['form'=>$form->createView(), 'sale'=>$sale]);
     }

}