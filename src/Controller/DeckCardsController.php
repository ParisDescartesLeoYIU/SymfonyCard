<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Card;
use App\Entity\Decks;
use App\Entity\DeckCards;
use App\Repository\CardRepository;
use App\Repository\DeckCardsRepository;
use App\Repository\DecksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeckCardsController extends AbstractController
{
    /**
     * @Route("/deck/cards", name="deck_cards")
     */
    public function index()
    {
        return $this->render('deck_cards/index.html.twig', [
            'controller_name' => 'DeckCardsController',
        ]);
    }


    /**
     * @Route("/get_deckcard/{id}", name="get_deck")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function getDeck(Request $request, int $id){


        $deck = new Decks();


        $decksRepo = $this->getDoctrine()->getRepository(Decks::class);
        $cardsRepo = $this->getDoctrine()->getRepository(Card::class);
        $repo = $this->getDoctrine()->getRepository(DeckCards::class);
        $deck = $decksRepo->find($id);
        $cards = $cardsRepo ->findAll();

        $deck_cards = $repo->findBy(array("deck" => $id));

        return $this->render('deck_cards/cardDeckView.html.twig', [
            'deck' => $deck,
            "deckcards" => $deck_cards,
            "cards" => $cards
        ]);
    }
    /**
     * @Route("/set_deckcard/{id_deck}/{id_card}", name="set_deck")
     * @param int $id_deck
     * @param int $id_card
     * @return Response
     * @ParamConverter("deck", options={"mapping"={"id"="id_deck"}})
     * @ParamConverter("card", options={"mapping"={"id"="id_card"}})
     */
    public function setDeck(int $id_deck, int $id_card){

        $decksRepo = $this->getDoctrine()->getRepository(Decks::class);
        $cardsRepo = $this->getDoctrine()->getRepository(Card::class);
        $repo = $this->getDoctrine()->getRepository(DeckCards::class);
        $deck = $decksRepo->find($id_deck);
        $card = $cardsRepo->find($id_card);

        $deckcard = new DeckCards();

        $card->addDeckCard($deckcard);
        $deck->addDeckCard($deckcard);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($deckcard);
        $entityManager->flush();

        $deck_cards = $repo->findBy(["deck" => $id_deck]);
        $cards = $cardsRepo->findAll();

        return $this->render('deck_cards/cardDeckView.html.twig');

    }


    /**
     * @Route("/remove_deckcard/{id}", name="remove_deckcard")
     * @ParamConverter("deckcard", options={"mapping"={"id"="id"}})
     * @param int $id
     * @return Response
     */
    public function removeDeckCard(int $id){

        $decksRepo = $this->getDoctrine()->getRepository(Decks::class);
        $cardsRepo = $this->getDoctrine()->getRepository(Card::class);
        $repo = $this->getDoctrine()->getRepository(DeckCards::class);


        $deckCards =$repo->find($id);

        $id_deck = $deckCards->getDeck()->getId();


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($deckCards);
        $entityManager->flush();

        $deck_cards = $repo->findBy(["deck" => $id_deck]);
        $deck = $decksRepo->find($id_deck);
        $cards = $cardsRepo->findAll();

        return $this->render('deck_cards/cardDeckView.html.twig', [
            'deck' => $deck,
            "deckcards" => $deck_cards,
            "cards" => $cards
        ]);

    }

}
