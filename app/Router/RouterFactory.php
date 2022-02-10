<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory
{
    use Nette\StaticClass;

    /**
     * @return RouteList<RouteList>
     */
    public static function createRouter(): RouteList
    {
        $router = new RouteList();

        $router->addRoute('odhlaseni', 'Homepage:logOut');

        $router->addRoute('admin/<presenter>/<action>[/<id>]', [
            'module' => 'Admin',
            'presenter' => 'Dashboard',
            'action' => 'default',
            'id' => null,
        ]);

        $router->addRoute('<presenter>/<action>', 'Homepage:default');

        return $router;
    }
}
