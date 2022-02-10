<?php

declare(strict_types=1);

namespace App\Model\Account\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class UserRepository extends EntityRepository
{
    public function getUsers(): QueryBuilder
    {
        return $this->createQueryBuilder('u');
    }
}
