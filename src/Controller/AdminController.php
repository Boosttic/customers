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

/**
 * @author Joachim Hanras-Graff <joachimhg@outlook.fr>
 */
class AdminController extends AbstractController
{

    /**
     * To create a new product
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
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
     * To create a new machine
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
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
     * To create a new providerOffer
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
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
     * To create a new provider
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
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
}