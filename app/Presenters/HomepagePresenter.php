<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Components\ISignInControlFactory;
use App\Components\SignInControl;
use Nette\Application\AbortException;

final class HomepagePresenter extends BasePresenter
{
    /** @var ISignInControlFactory @inject */
    public ISignInControlFactory $signInControlFactory;

    /** @throws AbortException */
    public function actionLogOut(): void
    {
        $this->getUser()->logout(true);
        $this->flashMessage('Jsi úspěšně odhlášený.');
        $this->redirect('Homepage:default');
    }

    public function createComponentSignInControl(): SignInControl
    {
        $control = $this->signInControlFactory->create();

        $control->onSuccess[] = (function () {
            $this->flashMessage('Gratuluji k úspěšnému přihlášení do administrace ;o)');
            $this->redirect(':Admin:Dashboard:');
        });

        return $control;
    }
}
