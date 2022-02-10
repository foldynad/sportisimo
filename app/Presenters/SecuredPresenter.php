<?php

declare(strict_types=1);

namespace App\Presenters;

use App\App;
use App\Model\Account\Entities\User;
use Nette\Application\AbortException;

abstract class SecuredPresenter extends BasePresenter
{
    /**
     * @throws AbortException
     */
    protected function startup()
    {
        parent::startup();

        if (!$this->getUser()->isloggedIn()) {
            $this->adminAccessDenied();
        }

        if (!$this->getUser()->isInRole(User::ROLE_SUPERADMIN) && !$this->getUser()->isInRole(User::ROLE_ADMIN)) {
            $this->adminAccessDenied();
        }

        if (!$this->getUser()->isAllowed('Admin:Dashboard')) {
            $this->moduleAccessDenied();
        }

        $this->template->userIdentity = $this->getUser()->getIdentity();
    }

    /**
     * @throws AbortException
     */
    protected function adminAccessDenied(): void
    {
        $this->flashMessage('Bohužel, ale do administrace nemáte přístup...');

        $this->redirect(App::DESTINATION_FRONT_HOMEPAGE);
    }

    /**
     * @throws AbortException
     */
    protected function moduleAccessDenied(): void
    {
        $this->flashMessage('Bohužel, ale pro přístup do této sekce nemáš dostatečná práva...');

        $this->redirect(App::DESTINATION_ADMIN_HOMEPAGE);
    }
}
