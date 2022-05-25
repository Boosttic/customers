<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 

class ContactController extends AbstractController
{	
	/**
	*@Route("/")
	*/
    public function info(ManagerRegistry $doctrine): Response
	{
	    $contact = new Contact();
	    $contact ->setName('Client_A')
           ->setEmail('clienta@gmail.com');
        
        $entityManager = $doctrine->getManager();
        $entityManager->persist($contact);
        $entityManager->flush();
	    return $this->render("Pages/home.html.twig");
	}
}
?>