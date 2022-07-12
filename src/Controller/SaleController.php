<?php

namespace App\Controller;

use App\Entity\Sale;
use App\Form\SaleType;
use App\Repository\CustomerRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SaleController extends AbstractController
{

    /**
     * @var CustomerRepository
     */
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * To create a new sale
     * @param string $id
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/createSale/{id}', name: 'page_creation_sale')]
    public function newSale(string $id, Request $request, ManagerRegistry $doctrine): Response
    {
        $sale = new Sale();
        $customer = $this->customerRepository->findById($id);

        $form = $this->createForm(SaleType::class, $sale);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            $customer->addSale($sale);
            foreach($sale->getMachines() as $machine)
            {
                foreach($machine->getApplications() as $app)
                {
                    $app->addSale($sale);
                    $product=$app->getProduct();
                    $product->addMachine($machine);
                    //$machine->setProduct($product);
                }
            }
            $entityManager->persist($sale);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Pages/Admin/creationsale.html.twig', ['customer'=>$customer, 'form'=>$form->createView()]);
    }

    /**
     * To edit a sale
     * @param string $id
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @param Sale $sale
     * @return Response
     */
    #[Route('/editSale/{id}', name: 'page_edition_sale')]
    public function editSale(string $id,  ManagerRegistry $doctrine, Request $request, Sale $sale): Response
    {
        $customer = $this->customerRepository->findById($id);
        $form = $this->createForm(SaleType::class, $sale);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $doctrine->getManager();
            $customer->addSale($sale);
            foreach($sale->getMachines() as $machine)
            {
                foreach($machine->getApplications() as $app)
                {
                    $app->addSale($sale);
                    $product=$app->getProduct();
                    $product->addMachine($machine);
                    //$machine->setProduct($product);
                }
            }
            $entityManager->persist($sale);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('Pages/Admin/edit/edit_sale.html.twig', ['customer'=>$customer, 'form'=>$form->createView()]);
    }

}