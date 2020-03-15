<?php

namespace App\Controller;

use App\Entity\Deck;
use App\Entity\DeckCards;
use App\Entity\Decks;
use App\Form\DecksType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Faction;
use App\Form\CardFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class DeckController extends AbstractController
{
    /**
     * @Route("/deck", name="deck")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Decks::class);
        $decks =  $repo->findBy(array("user" => $this->getUser()->getId()));

        return $this->render('deck/index.html.twig', [
            'decks' =>$decks
        ]);
    }

    /**
     * @route("/deck/create", name="create_deck")
     * @param Request $request
     * @return Response
     */
    public function createDeck(Request $request):Response
    {
        $deck = new Decks();
        $form = $this->createForm(DecksType::class, $deck);
        $entityManager = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //add creator

            $deck->setUser($this->getUser());

            $entityManager->persist($deck);
            $entityManager->flush();

            $this->addFlash('success', 'Deck Create !');
        }

        return $this->render('deck/form.html.twig', [

            'form' => $form->createView()

        ]);
    }

    /**
     * @Route("/deck/delete/{id}", name="delete_Deck")
     * @param Request $request
     * @param int $id
     * @ParamConverter("deck", options={"mapping"={"id"="id"}})
     * @return RedirectResponse|Response
     */
    public function removeDeck(Request $request, int $id){


        $entityManager = $this->getDoctrine()->getManager();
        $deckRepo = $this->getDoctrine()->getRepository(Deck::class);
        $deckCardRepo = $this->getDoctrine()->getRepository(DeckCards::class);
        $deck = $deckRepo->find($id);
        $deckcards = $deckCardRepo->findBy(array("decks" => $deck->getId()));

        // Remove card of the deck in database
        foreach($deckcards  as $deckcard ){
            $entityManager->remove($deckcard);
        }
        $entityManager->remove($deck);
        $entityManager->flush();

        $decks =  $deckRepo->findBy(array("user" => $this->getUser()->getId()));

        return $this->render('deck/index.html.twig', [
            'decks' =>$decks
        ]);
    }
}
