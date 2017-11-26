<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:03
 */

namespace Metrics\Controller;


class LoginController extends Controller
{
    public function index() : void
    {
        $this->view->cars = ["carro1", "carro2"];
        $this->render("index");
    }
}