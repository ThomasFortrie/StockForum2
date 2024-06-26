<?php

namespace App\Form;

use App\Entity\Matos;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('quantite')
          //  ->add('majDate', null, [
            //    'widget' => 'single_text',
          //  ])
            ->add('lastModif', ChoiceType::class, [
                'choices' => [
                    'Thomas' => 'Thomas',
                    'Pierre Luc' => 'Pierre Luc'
                ], 'label' => 'Utilisateur'
            ])
            ->add('save', SubmitType::class,[
                'label' => 'Soumettre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matos::class,
        ]);
    }
}
