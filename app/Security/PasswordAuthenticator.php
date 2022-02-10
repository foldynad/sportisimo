<?php

namespace App\Security;

use App\Model\Account\UserFacade;
use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;

class PasswordAuthenticator implements Authenticator
{
    public function __construct(private Passwords $passwords, private UserFacade $userFacade)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function authenticate(string $email, string $password): IIdentity
    {
        $user = $this->userFacade->findActiveUser($email);

        if (!$user || !$this->passwords->verify($password, $user->getPassword())) {
            throw new AuthenticationException('Zadané přihlašovací údaje nejsou správné.');
        }

        return $user;
    }
}
