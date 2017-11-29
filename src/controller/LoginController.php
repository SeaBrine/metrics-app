<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:03
 */

namespace Metrics\Controller;


use Metrics\Model\LoginModel;

class LoginController extends Controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
        parent::__construct();
    }

    public function index() : void
    {
        $this->render("index");
    }

    public function logout() : void
    {
        unset($_SESSION['token']);
        unset($_SESSION['id_user']);
        $this->render("index");
    }

    public function validar() : void
    {
        if ($this->loginModel->validLogin($_POST)) {
            $token = $this->loginModel->gerarToken($_POST);
            $this->loginModel->loginSession($token);
            $home = new HomeController();
            $home->index();
        } else {
            $this->render("index");
        }
    }
}