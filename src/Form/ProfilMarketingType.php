<?php

namespace App\Form;

use App\Entity\ProfilMarketing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilMarketingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('messageForTarget', TextType::class, [
                'label' => 'Quel message souhaitez-vous transmettre à votre cible ? ',
                'required' => true
            ])
            ->add('socialNetworkUsed', ChoiceType::class, [
                'label' => 'Cochez les réseaux sociaux que vous utilisez : ',
                'required' => true,
                'choices' => [
                    'LinkedIn' => 1,
                    'Instagram' => 2,
                    'Facebook' => 3,
                    'Tiktok' => 4,
                    'Twitter' => 5,
                    'Snapchat' => 6,
                    'Youtube' => 7,
                    'Pinterest' => 8,
                    'Aucun' => 9,
                    'Autre' => 10
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('prcSocialNetworkUse', TextType::class, [
                'label' => 'Si autre, pouvez-vous préciser ? ',
                'required' => false
            ])
            ->add('socialNetworkEngage', ChoiceType::class, [
                'label' => 'Sur quel réseau social vous avez le plus d\'engagement ? ',
                'required' => true,
                'choices' => [
                    'LinkedIn' => 1,
                    'Instagram' => 2,
                    'Facebook' => 3,
                    'Tiktok' => 4,
                    'Twitter' => 5,
                    'Snapchat' => 6,
                    'Youtube' => 7,
                    'Pinterest' => 8,
                    'Aucun' => 9,
                    'Autre' => 10
                ],
                'multiple' => false,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('prcSocialNetworkEn', TextType::class, [
                'label' => 'Si autre, pouvez-vous préciser ? ',
                'required' => false
            ])
            ->add('actionSeaMep', ChoiceType::class, [
                'label' => 'Quelles actions SEA avez-vous mis en place ? ',
                'required' => true,
                'choices' => [
                    'Googles ADS' => 1,
                    'Facebook ADS' => 2,
                    'Snapchat ADS' => 3,
                    'Tiktok ADS' => 4,
                    'Aucun' => 5,
                    'Autre' => 6
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('prcActionSeaMep', TextType::class, [
                'label' => 'Si autre, pouvez-vous préciser ? ',
                'required' => false
            ])
            ->add('actionSeoMep', ChoiceType::class, [
                'label' => 'Quelles actions SEO avez-vous mis en place ? ',
                'required' => true,
                'choices' => [
                    'Mots-clès' => 1,
                    'Localisation' => 2,
                    'Optimisation pour tous supports' => 3,
                    'Aucun' => 4,
                    'Autre' => 5
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ]);
        $this->buildFormLastPart($builder);
    }

    public function buildFormLastPart(FormBuilderInterface $builder): void
    {
        $builder
            ->add('prcActionSeoMep', TextType::class, [
                'label' => 'Si autre, pouvez-vous précisez ? ',
                'required' => false
            ])
            ->add('socialNetworkBestRoi', ChoiceType::class, [
                'label' => 'Sur quels canaux de médias sociaux votre entreprise obtient-elle le meilleur ROI ? ',
                'required' => true,
                'choices' => [
                    'LinkedIn' => 1,
                    'Instagram' => 2,
                    'Facebook' => 3,
                    'Tiktok' => 4,
                    'Twitter' => 5,
                    'Snapchat' => 6,
                    'Youtube' => 7,
                    'Pinterest' => 8,
                    'Aucun' => 9,
                    'Autre' => 10
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('prcSNBestRoi', TextType::class, [
                'label' => 'Si autre, pouvez-vous précisez ? ',
                'required' => false
            ])
            ->add('vectorMarketing', ChoiceType::class, [
                'label' => 'Quel est le principal vecteur par votre entreprise en matère de marketing ? ',
                'required' => true,
                'choices' => [
                    'Réseaux sociaux' => 1,
                    'SEO' => 2,
                    'Créations de contenu' => 3,
                    'Cold calling' => 4,
                    'Salons' => 5,
                    'Autre' => 6
                ],
                'multiple' => false,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('prcVectorMarketing', TextType::class, [
                'label' => 'Si autre, pouvez-vous précisez ? ',
                'required' => false
            ])
            ->add('priorityMarketing', ChoiceType::class, [
                'label' => 'Quelles sont les priorités marketing pour les 12 prochains mois ? ',
                'required' => true,
                'choices' => [
                    'Générer le plus de leads' => 1,
                    'Augmenter la notoriété de la marque' => 2,
                    'Améliorer la satisfation des clients' => 3,
                    'Conclure plus de transaction' => 4,
                    'Augmenter la rétention des clients' => 5,
                    'Autre' => 6
                ],
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
            ])
            ->add('prcPriorityMarketing', TextType::class, [
                'label' => 'Si autre, pouvez-vous précisez ? ',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfilMarketing::class,
        ]);
    }
}
