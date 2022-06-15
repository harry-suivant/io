<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Config\Framework\HttpClient\DefaultOptions\RetryFailedConfig;

class PasswordManager
{
    private function randomChar(int $start, int $end, array $forbiddenChar): string
    {
        do {
            $number = random_int($start, $end);
        } while (in_array($number, $forbiddenChar));

        return chr($number);
    }

    public function generate(int $length): string
    {
        $forbiddenChar = [34, 39, 47, 94, 96,];

        $password = "";

        for ($i = 0; $i < $length; $i++) {
            $password .= $this->randomChar(33, 125, $forbiddenChar);
        }

        return $password;
    }

    public function isPasswordValid(
        string $currentGivenPassword,
        string $newPassword,
        string $newPasswordConfirm
    ): bool {
        return ($currentGivenPassword !== $newPassword && $newPasswordConfirm === $newPassword);
    }
}
