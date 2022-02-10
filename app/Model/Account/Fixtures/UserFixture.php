<?php

declare(strict_types=1);

namespace App\Model\Account\Fixtures;

use App\Model\Account\Entities\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Persistence\ObjectManager;
use Nette\Security\Passwords;

class UserFixture extends AbstractFixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User(
            'admin@sportisimo.cz',
            'admin',
            (new Passwords())->hash('admin'),
            User::ROLE_ADMIN
        );

        $manager->persist($user);
        $manager->flush();
    }
}
