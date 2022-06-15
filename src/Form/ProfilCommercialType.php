<?php

namespace App\Form;

use App\Entity\ProfilCommercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilCommercialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('crmUsed', ChoiceType::class, [
            'label' => 'Selectionnez le CRM que vous utilisez : ',
            'required' => true,
            'choices'  => [
                'Hubspot' => 1,
                'Eudonet' => 2,
                'Pipedrive' => 3,
                'Aucun' => 4,
                'Autre' => 5,
            ],
        ])
        ->add('crmName', TextType::class, [
            'label' => 'Si autre, pouvez-vous préciser ? ',
            'required' => false
        ])
        ->add('timeOfProspec', ChoiceType::class, [
            'label' => 'Combien de temps par semaine passez-vous à la prospection ? ',
            'required' => true,
            'choices'  => [
                '1h-2h' => 1,
                '3h-4h' => 2,
                '6h-8h' => 3,
                '+8h' => 4,
                'Autre' => 5,
            ],
        ])
        ->add('precisTimeOfProspec', TextType::class, [
            'label' => 'Si autre, pouvez-vous préciser ? ',
            'required' => false
        ])
        ->add('typeOfProspec', ChoiceType::class, [
            'label' => 'Quel type de prospection mettez-vous en place ?',
            'choices'  => [
                'Téléphone' => 1,
                'Mail' => 2,
                'LinkedIn' => 3,
                'Instagram' => 4,
                'Facebook' => 5,
                'Aucune' => 6,
            ],
            'multiple' => true,
            'expanded' => true,
            'by_reference' => false,
            'required' => true,
        ])
        ->add('prospecMoreClient', ChoiceType::class, [
            'label' => 'Laquelle vous rapporte le plus de clients ? ',
            'choices'  => [
                'téléphone' => 1,
                'Mail' => 2,
                'LinkedIn' => 3,
                'Instagram' => 4,
                'Facebook' => 5,
                'Aucune' => 6
            ],
            'multiple' => false,
            'expanded' => true,
            'by_reference' => false,
            'required' => true,
        ]);
        $this->buildFormLastPart($builder);
    }

    public function buildFormLastPart(FormBuilderInterface $builder): void
    {
        $builder
        ->add('numberClosPerMonth', ChoiceType::class, [
            'label' => 'Combien de contrats faites-vous par mois ?',
            'required' => true,
            'choices'  => [
                '1-2 contrats' => 1,
                '3-5 contrats' => 2,
                '5-10 contrats' => 3,
                '+10 contrats' => 4,
                'Autre' => 5,
            ],
        ])
        ->add('precisClosPerMonth', TextType::class, [
            'label' => 'Si autre, pouvez-vous préciser ? ',
            'required' => false
        ])
        ->add('budOfProspPerMonth', ChoiceType::class, [
            'label' => 'Quel est le budget que vous investissez/mois dans la prospection ? ',
            'required' => true,
            'choices'  => [
                '0-100 Euros' => 1,
                '100-200 Euros' => 2,
                '200-300 Euros' => 3,
                '300-500 Euros' => 4,
                '500-1K Euros' => 5,
                '+1K Euros' => 6,
                'Autre' => 7,
            ],
        ])
        ->add('prcisBudProsMonth', TextType::class, [
            'label' => 'Si autre, pouvez-vous préciser ? ',
            'required' => false
        ])
        ->add('analyseProspec', ChoiceType::class, [
            'label' => 'Analysez-vous vos retours de campagne de prospection ? ',
            'required' => true,
            'choices' => ['Oui' => 1, 'Non' => 2],
            'multiple' => false,
            'expanded' => true,
            'by_reference' => false,
        ])
        ->add('satisfiedOfRoi', ChoiceType::class, [
            'label' => 'Etes-vous satisfait de votre ROI ? ',
            'required' => true,
            'choices' => ['Oui' => 1, 'Non' => 2],
            'multiple' => false,
            'expanded' => true,
            'by_reference' => false,
        ])
        ->add('priorityCommercial', ChoiceType::class, [
            'label' => 'Quelles sont vos priorités commerciales pour 12 mois à venir ?',
            'required' => true,
            'choices'  => [
                'Générer le plus de leads' => 1,
                'Améliorer la satisfaction des clients' => 2,
                'Augmenter la rétention des clients' => 3,
                'Augmenter la notoriété de la marque' => 4,
                'Conclure plus de transactions' => 5,
                'Autre' => 6
            ],
            'multiple' => true,
            'expanded' => true,
            'by_reference' => false,
        ])
        ->add('prcisPrioCommercial', TextType::class, [
            'label' => 'Si autre, pouvez-vous préciser ? ',
            'required' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfilCommercial::class,
        ]);
    }
}
