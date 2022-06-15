<?php

namespace App\Form;

use App\Entity\ActionCheck;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class IsActionCompleteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('isComplete', CheckboxType::class, [
                'row_attr' => ['class' => 'd-flex flex-row-reverse mt-5'],
                'label'    => 'j\'ai fini cette action!',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ActionCheck::class,
        ]);
    }
}
