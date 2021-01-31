<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Form\PersonnageType;
use App\Repository\PersonnageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnageController extends AbstractController
{
   protected $entity;

   public function __construct(EntityManagerInterface $entity)
   {
      $this->entity = $entity;
   }

   /**
     * @Route("/personnages", name="personnage_index")
     */
   public function index()
   {
      $personnages = $this->entity->getRepository(Personnage::class)
                     ->findBy(
                        [],
                        ['name' => 'ASC']);
                     

      return $this->render('personnage/index.html.twig',[
         'personnages' => $personnages
      ]);
   }

    /**
     * @Route("/create/personnage", name="personnage_create")
     */
    public function store(Request $request): Response
    {
       $personnage = new Personnage;

       $form = $this->createForm(PersonnageType::class, $personnage);
       $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $personnage->setUpdatedAt(new \DateTime);
            $this->entity->persist($personnage);
            $this->entity->flush();
         }
        return $this->render('personnage/create_personnage.html.twig',[
           'form' => $form->createView()
        ]);
    }
}
