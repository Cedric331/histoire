<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Form\PersonnageType;
use App\Repository\PersonnageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
   public function index(Request $request, PaginatorInterface $paginator)
   {
      $data = $this->entity->getRepository(Personnage::class)
                     ->findBy(
                        [],
                        ['name' => 'ASC']);
      $personnages = $paginator->paginate($data, $request->query->getInt('page', 1), 10);

      return $this->render('personnage/index.html.twig',[
         'personnages' => $personnages
      ]);
   }

    /**
     * @Route("/create/personnage", name="personnage_create")
     * @Route("/edit/personnage/{personnage}", name="personnage_edit")
     */
    public function store(Request $request, Personnage $personnage = null): Response
    {
         $create = false;
       if(!$personnage){
         $personnage = new Personnage;
         $create = true;
       }

       $form = $this->createForm(PersonnageType::class, $personnage);
       $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $personnage->setUpdatedAt(new \DateTime);
            $this->entity->persist($personnage);
            $this->entity->flush();
         }
        return $this->render('personnage/personnage_admin.html.twig',[
           'form' => $form->createView(),
           'create' => $create,
           'personnage' => $personnage
        ]);
    }
}
