<?php

namespace App\Controller;

use App\Entity\Card;
use App\Entity\Faction;
use App\Form\CardFormType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card")
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Card::class);
        $cards = $repo->findAll();


        return $this->render('card/index.html.twig', [
            'controller_name' => 'CardController',
            'cards' => $cards
        ]);
    }



    /**
     * @Route("/card", name="card_show")
     */
    public function show(){

        $repo = $this->getDoctrine()->getRepository(Card::class);
        $cards = $repo->findAll();
        return $this->render('card/index.html.twig',[
            'cards' => $cards
        ]);
    }



    /**
     * @route("/card/new", name="add_card")
     * @param Request $request
     * @return Response
     */
    public function addCard(Request $request):Response
    {
        $card = new Card();
        $form = $this->createForm(CardFormType::class, $card);
        $entityManager = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            // add creator
            $card->setUser($this->getUser());

            // add Image

            $image = $form->get('image')->getData();
            $imageName = 'card-'.uniqid().'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('cards_folder'),
                $imageName
            );
            $card->setImage($imageName);

            $entityManager->persist($card);
            $entityManager->flush();

            $this->addFlash('success', 'Carte ajouté !');

            return new Response();
        }

        return $this->render('card/form.html.twig', [

            'form' => $form->createView()

        ]);
    }
}
