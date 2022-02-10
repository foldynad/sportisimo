<?php

declare(strict_types=1);

namespace App\Model\Brands\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class BrandRepository extends EntityRepository
{
    public function getBrands(): QueryBuilder
    {
        return $this->createQueryBuilder('b');
    }
}
