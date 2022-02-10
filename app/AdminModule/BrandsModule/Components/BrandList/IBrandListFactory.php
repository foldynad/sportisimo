<?php

namespace App\AdminModule\BrandsModule\Components\BrandList;

interface IBrandListFactory
{
    public function create(): BrandList;
}
