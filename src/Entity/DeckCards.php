<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DeckCardsRepository")
 */
class DeckCards
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Card", inversedBy="deckCards")
     */
    private $card;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Decks", inversedBy="deckCards")
     */
    private $deck;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCard(): ?Card
    {
        return $this->card;
    }

    public function setCard(?Card $card): self
    {
        $this->card = $card;

        return $this;
    }

    public function getDeck(): ?Decks
    {
        return $this->deck;
    }

    public function setDeck(?Decks $deck): self
    {
        $this->deck = $deck;

        return $this;
    }
}
