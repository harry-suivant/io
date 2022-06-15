<?php

namespace App\DataFixtures;

use App\Entity\Ressource;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RessourceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $key = 0;
        $newRessource = new Ressource();
        $newRessource->setName('Bien débuter avec Facebook');
        $newRessource->setDescription("Facebook permet d'échanger idées, photos,
         vidéos etc. Même si l'utilisation de Facebook est simple ce tutoriel propose des précisions utiles sur
          ses principales possibilités et commandes, surtout si vous n'êtes pas très habitué à ce réseau social");
        $newRessource->setLink('https://www.youtube.com/watch?v=7YgfpA0mtz4');
        $newRessource->setUpdateAt(new DateTime());
        $manager->persist($newRessource);
        $this->addReference('ressource_' . ($key), $newRessource);

        $key++;
        $newRessource = new Ressource();
        $newRessource->setName('Bien débuter avec Facebook ADS');
        $newRessource->setDescription("Tout savoir sur Facebook ADS");
        $newRessource->setLink('https://www.youtube.com/watch?v=yjIBWCnsLs0');
        $newRessource->setUpdateAt(new DateTime());
        $manager->persist($newRessource);
        $this->addReference('ressource_' . ($key), $newRessource);

        $key++;
        $newRessource = new Ressource();
        $newRessource->setName('Bien débuter sur instagram');
        $newRessource->setDescription("Je vous dévoile enfin 5 ASTUCES pour comment bien Démarrer sur Instagram.");
        $newRessource->setLink('https://www.youtube.com/watch?v=mbKK2-dJhTs');
        $newRessource->setUpdateAt(new DateTime());
        $manager->persist($newRessource);
        $this->addReference('ressource_' . ($key), $newRessource);

        $key++;
        $newRessource = new Ressource();
        $newRessource->setName('Comment avoir ses 1000 premier Followers');
        $newRessource->setDescription("Dans cette vidéo, j'ai le plaisir d'interviewer Adam Ihya. Ancien vendeur
         de sushis dans la région Lyonnaise, il est actuellement devenu Mr Instagram.");
        $newRessource->setLink('https://www.youtube.com/watch?v=5K3NYxT9NWI');
        $newRessource->setUpdateAt(new DateTime());
        $manager->persist($newRessource);
        $this->addReference('ressource_' . ($key), $newRessource);

        $manager->flush();
    }
}
