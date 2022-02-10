<?php

declare(strict_types=1);

namespace App\Model\Account;

use App\Model\Account\Entities\User;
use App\Model\Account\Repositories\UserRepository;
use Nette\SmartObject;

class UserFacade
{
    use SmartObject;

    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function findUser(int $id): ?User
    {
        return $this->userRepository->find($id);
    }

    public function findActiveUser(string $email): ?User
    {
        return $this->userRepository->findOneBy(['email' => $email, 'active' => true]);
    }
}
