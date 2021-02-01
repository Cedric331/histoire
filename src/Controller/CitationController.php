<?php

namespace App\Controller;

use App\Entity\Citation;
use App\Form\CitationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CitationController extends AbstractController
{
   protected $entity;

   public function __construct(EntityManagerInterface $entity)
   {
      $this->entity = $entity;
   }

   /**
    * @Route("/citation", name="citation_index")
    *
    * @return void
    */
   public function index()
   {
      $citations = $this->entity->getRepository(Citation::class)->findAll();

      return $this->render('citation/index.html.twig',[
         'citations' => $citations
      ]);
   }
   
    /**
     * @Route("/citation/create", name="citation_create")
     */
    public function store(Request $request): Response
    {
      $citation = new Citation;
      $form = $this->createForm(CitationType::class, $citation);

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $this->entity->persist($citation);
         $this->entity->flush();
      }

      return $this->render('citation/store.html.twig',[
         'form' => $form->createView()
      ]);
    }
}
