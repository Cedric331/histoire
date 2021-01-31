<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Form\PersonnageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonnageController extends AbstractController
{
    /**
     * @Route("/create/personnage", name="personnage_create")
     */
    public function create(Request $request): Response
    {
       $personnage = new Personnage;
       
       $form = $this->createForm(PersonnageType::class, $personnage);

        return $this->render('personnage/createPersonnage.html.twig',[
           'form' => $form->createView()
        ]);
    }
}
