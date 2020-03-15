<?php

namespace App\Controller;

use App\Entity\Faction;
use App\Form\FactionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class FactionController extends AbstractController
{




    /**
     * @Route("/faction", name="faction")
     */
    public function show(){

        $repo = $this->getDoctrine()->getRepository(Faction::class);
        $factions = $repo->findAll();
        return $this->render('faction/index.html.twig',[
            'factions' => $factions
        ]);
    }



    /**
     * @route("/faction/new", name="add_faction")
     * @param Request $request
     * @return Response
     */
    public function addFaction(Request $request):Response
    {
        $faction = new Faction();
        $form = $this->createForm(FactionFormType::class, $faction);
        $entityManager = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($faction);
            $entityManager->flush();

            $this->addFlash('success', 'Faction Add !');
        }

        return $this->render('faction/form.html.twig', [

            'form' => $form->createView()

        ]);
    }


    /**
     * @Route("/update/Faction/{id}", name="update_Faction")
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function updateFaction(Request $request, int $id){

        // Get all data form
        $repo = $this->getDoctrine()->getRepository(Faction::class);
        $faction = $repo->find($id);

        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(FactionFormType::class, $faction);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            // Add Factions in database
            $entityManager->persist($faction);
            $entityManager->flush();

            return new Response();
        }

        return $this->render('faction/form.html.twig',[
            "form" => $form->createView(),
        ]);
    }

}
