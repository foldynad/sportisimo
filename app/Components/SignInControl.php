<?php

declare(strict_types=1);

namespace App\Components;

use App\Security\PasswordAuthenticator;
use Nette;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Nette\Security\User;

/**
 * @method onSuccess()
 */
class SignInControl extends Nette\Application\UI\Control
{
    public array $onSuccess = [];

    public function __construct(
        private User $user,
        private PasswordAuthenticator $passwordAuthenticator
    ) {
    }

    public function createComponentForm(): Form
    {
        $form = new Form();

        $form->addText('email', 'E-mail:')
            ->setRequired('Zadejte prosím e-mail.');

        $form->addPassword('password', 'Heslo:')
            ->setRequired('Zadejte prosím heslo.');

        $form->addSubmit('submit', 'Přihlásit se');

        $form->onSuccess[] = function (Form $form, $values) {
            try {
                $user = $this->passwordAuthenticator->authenticate($values->email, $values->password);
                $this->user->login($user);

                $this->onSuccess();
            } catch (AuthenticationException $e) {
                $form->addError($e->getMessage());
            }
        };

        return $form;
    }

    public function render()
    {
        $this->getTemplate()->setFile(__DIR__ . '/control.latte');
        $this->getTemplate()->render();
    }
}
