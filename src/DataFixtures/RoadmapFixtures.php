<?php

namespace App\DataFixtures;

use App\Entity\Roadmap;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RoadmapFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $newRoadmap = new Roadmap();
        $newRoadmap->setName('Reseaux Sociaux');
        $newRoadmap->addStep($this->getReference('Facebook'));
        $newRoadmap->addStep($this->getReference('Instagram'));

        $manager->persist($newRoadmap);
        $this->addReference('roadmap', $newRoadmap);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            StepFixtures::class
        ];
    }
}
