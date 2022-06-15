<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class PasswordChangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('currentPassword', PasswordType::class, ['label' => 'Mot de passe actuel: '])
            ->add('newPassword', PasswordType::class, ['label' => 'Nouveau mot de passe: '])
            ->add('newPasswordConfirm', PasswordType::class, ['label' => 'Confirmez votre mot de passe: '])
            ->add('submit', SubmitType::class, ['label' => 'Enregistrer']);
    }
}
