<?php

namespace Lucas\PortalAcademico\Application;

use Lucas\PortalAcademico\Infrastructure\Adapter\Routes\Router;

class Application
{
    public function __construct()
    {
        $routes = require(__DIR__.'/../../config/routes.php');

        $router = new Router($routes);

        $route = $router->resolve();
        
        $instance = new ($route->controller)();

        $instance->{$route->method}();
    }
}