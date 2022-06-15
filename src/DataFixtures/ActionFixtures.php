<?php

namespace App\DataFixtures;

use App\Entity\Action;
use App\DataFixtures\RessourceFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActionFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTION = [
        ['Création compte facebook', 'Pour créer un compte Facebook :
        Accédez à facebook.com et cliquez sur Créer un compte.
        Renseignez votre nom, votre adresse e-mail ou votre numéro de mobile, votre mot de passe, 
        votre date de naissance et votre genre.
        Cliquez sur Inscription.
        Pour finaliser la création de votre compte, vous devez confirmer votre adresse e-mail ou votre numéro de mobile
        .Si vous rencontrez des problèmes pour créer un compte Facebook :
        Pour nous informer du problème que vous rencontrez lors de la création de votre compte Facebook, 
        vous pouvez remplir ce formulaire.', [0]],
        ['Modification compte facebook', 'Voici comment trouver vos paramètres :
            Cliquez sur account en haut à droite de Facebook.
            Sélectionnez Paramètres et confidentialité, puis cliquez sur Paramètres.
            Cliquez sur le paramètre que vous souhaitez mettre à jour en choisissant
            l’une des options dans la barre latérale gauche.
            Les paramètres incluent les catégories suivantes :
            Général : modifiez des informations de base, comme votre nom, votre nom d’utilisateur ou 
            votre adresse e-mail.
            Sécurité et connexion : modifiez votre mot de passe, puis activez les alertes 
            et les autorisations afin de sécuriser votre compte.
            Confidentialité : choisissez qui peut voir vos futures publications et qui peut vous trouver.
            Profil et identification : choisissez qui peut voir votre journal et 
            les publications dans lesquelles vous êtes identifié(e).
            Blocage : gérez les éléments et les personnes à bloquer.
            Langue et région : sélectionnez la langue et le format de date que vous souhaitez utiliser sur Facebook.'
            , [1]],
        ['Création compte instagram', "Rendez-vous sur l'App Store ou sur Google Play pour télécharger l'application
         Instagram. Ouvrez l'application en cliquant sur l'icône. Sur la page d'accueil, cliquez sur S'inscrire avec un
         e-mail 
        ou un numéro de téléphone ou sur Créer un compte.
        Une boîte de dialogue s'affiche et demande l'autorisation d'accéder à vos contacts. Cliquez sur Refuser ou 
        Autoriser.
        Complétez le champ libre avec votre numéro de téléphone ou votre mail, puis cliquez sur le bouton Suivant."
        , [2]],
        ['Modification compte instagram', "Ouvrez votre application Instagram en appuyant sur la célèbre 
        icône multicolore représentant un appareil photo. Ensuite, dirigez-vous sur votre compte personnel.
        Pour ce faire, touchez la petite photo de profil qui se trouve tout en bas à droite de votre écran.
        Une fois sur votre page, appuyez sur la mention « Modifier le profil » qui se trouve entre vos photos publiées
        et les informations de votre compte.
        Sélectionnez alors la ligne « Username » sur laquelle est inscrit votre nom d'utilisateur actuel. 
        Supprimez-le et écrivez le nouveau nom que vous souhaitez adopter pour votre compte. 
        Instagram va valider ou non votre proposition, selon la disponibilité de votre choix.", [3]],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTION as $key => $actionTab) {
            $action = new Action();

            $action->setName($actionTab[0]);
            $action->setText($actionTab[1]);


            foreach ($actionTab[2] as $ressourceId) {
                $action->addRessource($this->getReference('ressource_' . $ressourceId));
            }

            $manager->persist($action);
            $this->addReference('action_' . ($key), $action);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RessourceFixtures::class,
        ];
    }
}
