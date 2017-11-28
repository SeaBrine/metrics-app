<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 15:31
 */

namespace Metrics;


class Route
{
    private $route;

    public function __construct()
    {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    public function run(string $url) : void
    {
        array_walk($this->route, function($route) use ($url) {
            if ($url == $route['route']) {
                $class = "Metrics\\Controller\\".ucfirst($route['controller']);
                $controller = new $class;
                $action = $route['action'];
                $controller->$action();
            }
        });
    }

    public function initRoutes() : void
    {
        $routes[] = array(
            "route" => "/",
            "controller" => "loginController",
            "action" => "index"
        );

        $routes[] = array(
            "route" => "/login/validar",
            "controller" => "loginController",
            "action" => "validar"
        );

        $routes[] = array(
            "route" => "/logout",
            "controller" => "loginController",
            "action" => "logout"
        );

        $routes[] = array(
            "route" => "/home",
            "controller" => "homeController",
            "action" => "index"
        );

        $this->setRoute($routes);
    }

    public function setRoute(array $route) : void
    {
        $this->route = $route;
    }

    public function getUrl() : ?string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }
}