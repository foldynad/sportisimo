<?php

declare(strict_types=1);

namespace App\AdminModule\BrandsModule\Components\BrandList;

use App\AdminModule\BrandsModule\Components\BrandForm\BrandForm;
use App\AdminModule\BrandsModule\Components\BrandForm\IBrandFormFactory;
use App\AdminModule\Components\BaseList;
use App\Model\Brands\BrandFacade;
use Doctrine\ORM\QueryBuilder;
use Nette\SmartObject;

class BrandList extends BaseList
{
    use SmartObject;

    public ?int $brandId = null;

    public function __construct(private BrandFacade $brandFacade, public IBrandFormFactory $brandFormFactory)
    {
        parent::__construct();
    }

    public function render()
    {
        parent::render();

        $this->template->brandId = $this->brandId;
        $this->template->brand = $this->brandId ? $this->brandFacade->findBrand($this->brandId) : null;
        $this->template->data = $this->getData();

        $this->template->setFile(__DIR__ . '/brandList.latte');
        $this->template->render();
    }

    public function handleEditBrand(?int $brandId)
    {
        $this->brandId = $brandId;

        $this->redrawControl();
    }

    public function handleDeleteBrand(int $brandId)
    {
        $brand = $this->brandFacade->findBrand($brandId);

        if ($brand) {
            $this->brandFacade->deleteBrand($brand);

            $this->flashMessage('Úspěšně smazáno.');
            $this->redrawControl();
        }
    }

    public function prepareData(): QueryBuilder
    {
        $qb = $this->brandFacade->getBrands();

        $qb->addOrderBy('b.name', $this->getOrder());

        return $qb;
    }

    public function createComponentBrandForm(): BrandForm
    {
        $brand = $this->brandId
            ? $this->brandFacade->findBrand($this->brandId)
            : null;

        $component = $this->brandFormFactory->create($brand);

        $component->onSuccess[] = function () {
            $this->redrawControl();
        };

        return $component;
    }
}
