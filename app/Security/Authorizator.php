<?php

declare(strict_types=1);

namespace App\Security;

use App\Model\Account\Entities\User;
use Nette\Security\Permission;

final class Authorizator extends Permission
{
    public function __construct()
    {
        $this->addRoles();
        $this->addResources();
        $this->addPermissions();
    }

    protected function addRoles(): void
    {
        $this->addRole(User::ROLE_SUPERADMIN);
        $this->addRole(User::ROLE_ADMIN);
    }
    
    protected function addResources(): void
    {
        $this->addResource('Admin:Dashboard');
        $this->addResource('Admin:Brands');
    }

    protected function addPermissions(): void
    {
        $this->allow(User::ROLE_SUPERADMIN, self::ALL);
        $this->allow(User::ROLE_ADMIN, [
            'Admin:Dashboard',
            'Admin:Brands',
        ]);
    }
}
