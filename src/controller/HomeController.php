<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:04
 */

namespace Metrics\Controller;


class HomeController extends Controller
{
    public function index() : void
    {
        $this->view->teste = "Daniel Silva";
        $this->render("index");
    }
}