<?php

namespace App\DataFixtures;

use App\Entity\ActionCheck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActionCheckFixtures extends Fixture implements DependentFixtureInterface
{
    public const ACTIONCHECK = [
        [0, 0, false],
        [1, 0, false],
        [2, 1, false],
        [3, 1, false]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACTIONCHECK as $actionCheckTab) {
            $actionCheck = new ActionCheck();

            $actionCheck->setAction($this->getReference('action_' . $actionCheckTab[0]));
            $actionCheck->setStepCheck($this->getReference('StepCheck_' . $actionCheckTab[1]));
            $actionCheck->setIsComplete($actionCheckTab[2]);
            $manager->persist($actionCheck);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RessourceFixtures::class,
            ActionFixtures::class,
            StepCheckFixtures::class,
        ];
    }
}
