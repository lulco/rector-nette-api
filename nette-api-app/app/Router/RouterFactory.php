<?php

namespace App;

use Nette\Application\IRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;

class RouterFactory
{
    public static function createRouter(): ?IRouter
    {
        $router = new RouteList();
        $router[] = new Route('api/v<version>/<package>[/<apiAction>][/<params>]', 'Api:Api:default');
        $router[] = new Route('<module>/<presenter>/<action>[/<id>]', 'Admin:Api:default');
        $router[] = new Route('/', 'Admin:Api:default');
        return $router;
    }
}
