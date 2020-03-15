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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
            $card->setUser($this->getUser());

            $image = $form->get('image')->getData();
            $imageName = 'card-'.uniqid().'.'.$image->guessExtension();

            $image->move(
                $this->getParameter('cards_folder'),
                $imageName
            );
            $card->setImage($imageName);

            $entityManager->persist($card);
            $entityManager->flush();

            $this->addFlash('success', 'Card Add !');

            return new Response();
        }

        return $this->render('card/form.html.twig', [

            'form' => $form->createView()

        ]);
    }
    /**
     * @Route("/card/delete/{id}", name="delete_card")
     * @ParamConverter("card", options={"mapping"={"id"="id"}})
     * @param int $id_card
     * @return Response
     */
    public function deleteCard(int $id){

        $repo = $this->getDoctrine()->getRepository(Card::class);
        $card = $repo->find($id);
        //pour le retour
        $em = $this->getDoctrine()->getManager();
        $em->remove($card);
        $em->flush();

        $this->addFlash('success', 'Card Delete !');
        $cards = $repo->findAll();
        return $this->render('card/index.html.twig', [
            'cards' => $cards
        ]);
    }
}
