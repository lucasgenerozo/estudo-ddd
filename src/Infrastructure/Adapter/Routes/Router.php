<?php
namespace Lucas\PortalAcademico\Infrastructure\Adapter\Routes;

use Lucas\PortalAcademico\Infrastructure\Adapter\Controllers\HomeController;

class Router
{

    private array $post;
    private array $get;

    public function __construct(array $routes_group = [])
    {
        foreach ($routes_group as $request_method => $routes) {
            $request_method = strtolower($request_method);

            foreach ($routes as $path => $route_prototype) {
                //echo "<br>$path => $route_prototype";

                if (is_array($route_prototype)) {
                    list($controller, $controller_method) = $route_prototype;
                } else {
                    $controller = $route_prototype;
                    $controller_method = 'index';
                }

                $this->{$request_method}[$path] = new Route(
                    $path,
                    $controller,
                    $controller_method
                );
            }
        }
    }

    public function resolve(): Route
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $path = $_SERVER['PATH_INFO'] ?? '/';

        if (!isset($this->$method[$path])) {
            $controller = HomeController::class;
            $method = 'notFound';

            return new Route(
                $path,
                $controller,
                $method
            );
        }

        return $this->$method[$path];
    }
}