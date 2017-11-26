<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:42
 */

namespace Metrics\Controller;


class Controller
{
    public $view;

    function __construct()
    {
        $this->view = new \stdClass();
    }

    public function render(string $action) : void
    {
        $current = get_class($this);
        $singleClassName = strtolower(
            str_replace("Controller", "", str_replace(
                "Metrics\\Controller\\",
                "",
                $current
            )));

        include_once "../src/views/".$singleClassName."/".$action.".phtml";
    }
}