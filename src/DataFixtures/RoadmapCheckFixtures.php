<?php

namespace App\DataFixtures;

use App\Entity\RoadmapCheck;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RoadmapCheckFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $newRoadmapCheck = new RoadmapCheck();
        $newRoadmapCheck->setUser($this->getReference('user_1'));
        $newRoadmapCheck->setRoadmap($this->getReference('roadmap'));
        $newRoadmapCheck->setIsComplete(false);

        $manager->persist($newRoadmapCheck);
        $this->addReference('RoadmapCheck_0', $newRoadmapCheck);

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            UserFixtures::class,
            RoadmapFixtures::class
        ];
    }
}
