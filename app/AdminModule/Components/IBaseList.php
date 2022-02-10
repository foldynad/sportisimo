<?php

declare(strict_types=1);

namespace App\AdminModule\Components;

use Doctrine\ORM\QueryBuilder;

interface IBaseList
{
    public function prepareData(): QueryBuilder;
}
