<?php

namespace App\Form;

use App\Entity\Card;
use App\Entity\Faction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CardFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('mana')
            ->add('atk')
            ->add('health')
            ->add('faction', EntityType::class, [
                'class' => Faction::class,
                'choice_label' => function(Faction $faction) {
                    return $faction->getName();
                }
            ])
            ->add('rarity',ChoiceType::class,[
                "choices"  => [
                    'bronze'=> "bronze",
                    'silver'=> "silver",
                    'gold'=> "gold",
                    'legendary'=> "legendary",
                    ],
            ])
            ->add('image',FileType::class)

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
