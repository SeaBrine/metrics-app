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

        $routes[] = array(
            "route" => "/home/graphic",
            "controller" => "homeController",
            "action" => "graphic"
        );

        $routes[] = array(
            "route" => "/cadastrar",
            "controller" => "exerciseController",
            "action" => "index"
        );

        $routes[] = array(
            "route" => "/cadastrar/salvar",
            "controller" => "exerciseController",
            "action" => "salvar"
        );

        $routes[] = array(
            "route" => "/listar",
            "controller" => "exerciseController",
            "action" => "listar"
        );

        $routes[] = array(
            "route" => "/atualizar",
            "controller" => "exerciseController",
            "action" => "formAtualizar"
        );

        $routes[] = array(
            "route" => "/cadastrar/buscarDados",
            "controller" => "exerciseController",
            "action" => "buscarDados"
        );

        $routes[] = array(
            "route" => "/cadastrar/atualizar",
            "controller" => "exerciseController",
            "action" => "atualizar"
        );

        $routes[] = array(
            "route" => "/cadastrar/delete",
            "controller" => "exerciseController",
            "action" => "excluir"
        );

        $routes[] = array(
            "route" => "/pomodoro",
            "controller" => "timerController",
            "action" => "index"
        );

        $routes[] = array(
            "route" => "/timer/salvar",
            "controller" => "timerController",
            "action" => "salvar"
        );

        $routes[] = array(
            "route" => "/timer/listar",
            "controller" => "timerController",
            "action" => "listar"
        );

        $routes[] = array(
            "route" => "/timer/delete",
            "controller" => "timerController",
            "action" => "deletar"
        );

        $routes[] = array(
            "route" => "/home/graphicBanca",
            "controller" => "homeController",
            "action" => "graphicBanca"
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