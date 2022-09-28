<?php

declare(strict_types=1);

namespace App\AdminModule\BrandsModule\Components\BrandForm;

use App\AdminModule\Components\BaseForm;
use App\Model\Brands\BrandFacade;
use App\Model\Brands\Entities\Brand;
use Nette\Application\UI\Form;
use Nette\SmartObject;
use Nette\Utils\ArrayHash;

class BrandForm extends BaseForm
{
    use SmartObject;

    public array $onSuccess = [];

    public function __construct(private BrandFacade $brandFacade, private ?Brand $brand = null)
    {
    }

    public function createComponentForm($name): Form
    {
        $form = new Form();

        $form->setHtmlAttribute('class', 'ajax');

        $form->addText('name', 'Název značky')
            ->setRequired('Zadejte název značky');

        $form->addHidden('brandId', $this->brand?->getId());

        $form->addSubmit('submit', 'Uložit')
            ->setHtmlAttribute('class', 'btn');

        $form->onSuccess[] = [$this, 'submitSucceeded'];

        if ($this->brand) {
            $form->setDefaults([
                'name' => $this->brand->getName()
            ]);
        }

        return $form;
    }

    public function submitSucceeded(Form $form, ArrayHash $values): void
    {
        $brand = $values->brandId
            ? $this->brandFacade->findBrand((int)$values->brandId)
            : $this->brandFacade->createBrand($values->name);

        $brand->setName($values->name);

        try {
            $this->brandFacade->saveBrand($brand);
        } catch (\Exception $e) {
            $form->addError('Neco je spatne...');
        }

        $this->onSuccess();
    }
}
