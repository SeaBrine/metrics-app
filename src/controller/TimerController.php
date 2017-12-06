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

    public function salvar() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $hora = (int) $_POST['hora'];
            $minutos = (int) $_POST['minutos'];
            $segundos = (int) $_POST['segundos'];

            echo json_encode(array(
                "result" => $this->timerModel->salvar($hora, $minutos, $segundos)
            ));
        } else {
            $this->login->index();
        }
    }

    public function listar(): void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $this->view->times = $this->timerModel->obter($_SESSION['id_user']);
            $this->render("listar");
        } else {
            $this->login->index();
        }
    }
}