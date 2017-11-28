<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:04
 */

namespace Metrics\Controller;


use Metrics\Model\LoginModel;

class HomeController extends Controller
{
    private $login;
    private $loginModel;

    public function __construct()
    {
        $this->login = new LoginController();
        $this->loginModel = new LoginModel();
        parent::__construct();
    }

    public function index() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $this->render("index");
        } else {
            $this->login->index();
        }
    }

    public function graphic() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            echo json_encode(["teste" => "Daniel", "age" => 28]);
        } else {
            $this->login->index();
        }

    }
}