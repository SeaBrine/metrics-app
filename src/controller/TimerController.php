<?php
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 03/12/17
 * Time: 18:20
 */

namespace Metrics\Controller;


use Metrics\Model\LoginModel;
use Metrics\Model\TimerModel;

class TimerController extends Controller
{
    private $login;
    private $loginModel;
    private $timerModel;

    public function __construct()
    {
        $this->login = new LoginController();
        $this->loginModel = new LoginModel();
        $this->timerModel = new TimerModel();
        parent::__construct();
    }

    public function index() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $this->render("pomodoro");
        } else {
            $this->login->index();
        }
    }
}