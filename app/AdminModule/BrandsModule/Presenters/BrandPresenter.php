<?php

declare(strict_types=1);

namespace App\AdminModule\BrandsModule\Presenters;

use App\AdminModule\BrandsModule\Components\BrandList\BrandList;
use App\AdminModule\BrandsModule\Components\BrandList\IBrandListFactory;
use App\Presenters\SecuredPresenter;
use Nette\Application\AbortException;

final class BrandPresenter extends SecuredPresenter
{
    public function __construct(
        /** @inject */
        public IBrandListFactory $brandListFactory
    ) {
        parent::__construct();
    }

    /**
     * @throws AbortException
     */
    protected function startup()
    {
        parent::startup();

        if (!$this->getUser()->isAllowed('Admin:Brands')) {
            $this->moduleAccessDenied();
        }
    }

    public function createComponentBrandList(): BrandList
    {
        return $this->brandListFactory->create();
    }
}
