<?php

namespace App\DataFixtures;

use App\Entity\Step;
use App\Entity\StepCheck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class StepCheckFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $newStepCheck = new StepCheck();
        $newStepCheck->setStep($this->getReference('Facebook'));
        $newStepCheck->setRoadmapCheck($this->getReference('RoadmapCheck_0'));
        $newStepCheck->setIsComplete(false);
        $manager->persist($newStepCheck);
        $this->addReference('StepCheck_0', $newStepCheck);

        $newStepCheck = new StepCheck();
        $newStepCheck->setStep($this->getReference('Instagram'));
        $newStepCheck->setRoadmapCheck($this->getReference('RoadmapCheck_0'));
        $newStepCheck->setIsComplete(false);
        $manager->persist($newStepCheck);
        $this->addReference('StepCheck_1', $newStepCheck);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RoadmapCheckFixtures::class,
            StepFixtures::class,
        ];
    }
}
