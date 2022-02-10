<?php

namespace App\AdminModule\BrandsModule\Components\BrandForm;

use App\Model\Brands\Entities\Brand;

interface IBrandFormFactory
{
    public function create(?Brand $brand): BrandForm;
}
