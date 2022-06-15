<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasder;
    public const USERS = [
        ['jcriotte69@gmail.com', 'Jean-Christophe', 'RIOTTE', ['ROLE_ADMIN'], true, 'jcriotte69'],
        ['client69@gmail.com', 'Harry', 'SUIVANT', [''], false, 'client'],
        ['client1@gmail.com', 'Paul', 'client1', [''], false, 'client1'],
        ['client2@gmail.com', 'Jerome', 'client2', [''], false, 'client2'],
        ['client3@gmail.com', 'Thomas', 'client3', [''], false, 'client3'],
        ['client4@gmail.com', 'Fabrice', 'client4', [''], false, 'client4']
    ];

    public function __construct(UserPasswordHasherInterface $passwordHasderInt)
    {
        $this->passwordHasder = $passwordHasderInt;
    }
    public function load(ObjectManager $manager): void
    {
        $key = 0;
        foreach (self::USERS as $user) {
            $newUser = new User();
            $newUser->setEmail($user[0]);
            $newUser->setFirstname($user[1]);
            $newUser->setLastname($user[2]);
            $newUser->setRoles($user[3]);
            $newUser->setFirstConnection($user[4]);
            $plaintextPassword = ($user[5]);
            // hash the password (based on the security.yaml config for the $user class)
            $hashedPassword = $this->passwordHasder->hashPassword(
                $newUser,
                $plaintextPassword
            );
            $newUser->setPassword($hashedPassword);
            $manager->persist($newUser);
            $this->addReference('user_' . $key, $newUser);
            $key++;
        }

        $manager->flush();
    }
}
