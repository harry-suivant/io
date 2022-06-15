<?php

namespace App\DataFixtures;

use App\Entity\Step;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StepFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $newStep = new Step();
        $newStep->setName('Facebook');
        $newStep->addAction($this->getReference('action_0'));
        $newStep->addAction($this->getReference('action_1'));
        $manager->persist($newStep);
        $this->addReference('Facebook', $newStep);

        $newStep = new Step();
        $newStep->setName('Instagram');
        $newStep->addAction($this->getReference('action_2'));
        $newStep->addAction($this->getReference('action_3'));
        $manager->persist($newStep);
        $this->addReference('Instagram', $newStep);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ActionFixtures::class,
            RessourceFixtures::class,
        ];
    }
}
