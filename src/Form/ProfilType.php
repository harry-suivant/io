<?php

namespace App\Form;

use App\Entity\Profil;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numberSiren', TextType::class, [
                'label' => 'Numèro de SIREN : '
            ])
            ->add('sizeFirm', ChoiceType::class, [
                'label' => 'Taille de l\'entreprise : ',
                'choices' => [
                    'Micro-entreprise' => 0,
                    'Très petite entreprise' => 1,
                    'Petite entreprise' => 2,
                    'Moyenne entreprise' => 3,
                    'Grande entreprise' => 4,
                    'Très grande entreprise' => 5
                ],
            ])
            ->add('sectorFirm', ChoiceType::class, [
                'label' => 'Secteur d\'activité : ',
                'choices' => [
                    'Agriculture, sylviculture et pêche' => 0,
                    'Industries extractives' => 1,
                    'Industrie manufacturière' => 2,
                    'Production et distribution d\'électricité, de gaz, de vapeur et d\'air conditionné' => 3,
                    'Production et distribution d\'eau ; assainissement, gestion des déchets et dépollution' => 4,
                    'Construction' => 5,
                    'Commerce ; réparation d\'automobiles et de motocycles' => 6,
                    'Transports et entreposage' => 7,
                    'Hébergement et restauration' => 8,
                    'Information et communication' => 9,
                    'Activités financières et d\'assurance' => 10,
                    'Activités immobilières' => 11,
                    'Activités spécialisées, scientifiques et techniques' => 12,
                    'Activités de services administratifs et de soutien' => 13,
                    'Administration publique' => 14,
                    'Enseignement' => 15,
                    'Santé humaine et action sociale' => 16,
                    'Arts, spectacles et activités récréatives' => 17,
                    'Autres activités de services' => 18,
                    'Activités des ménages en tant qu\'employeurs ; activités indifférenciées des ménages
                     en tant que producteurs de biens et services pour usage propre' => 19,
                    'Activités extra-territoriales' => 20
                ],
            ])
            ->add('numberSales', MoneyType::class, [
                'label' => 'CA en 2021 : '
            ])
            ->add('poleMarketing', ChoiceType::class, [
                'label'    => 'Pôle marketing au sein de votre entreprise ?',
                'choices' => ['Oui' => 1, 'Non' => 2],
                'multiple' => false,
                'expanded' => true,
                'by_reference' => false,
                'required' => true,
            ])
            ->add('numberMarketers', IntegerType::class, [
                'label' => 'Si oui combien de personnes ? ',
                'required' => false,
                'attr' => [
                    'style' => '-moz-appearance: textfield;']
            ])
            ->add('poleCommercial', ChoiceType::class, [
                'label'    => 'Pôle commercial au sein de votre entreprise ?',
                'choices' => ['Oui' => 1, 'Non' => 2],
                'multiple' => false,
                'expanded' => true,
                'by_reference' => false,
                'required' => true,
            ])
            ->add('numberCommercial', IntegerType::class, [
                'label' => 'Si oui combien de personnes ? ',
                'required' => false,
                'attr' => [
                    'style' => '-moz-appearance: textfield;']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
