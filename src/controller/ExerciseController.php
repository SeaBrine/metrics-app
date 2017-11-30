<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 28/11/17
 * Time: 22:04
 */

namespace Metrics\Controller;


use Metrics\Model\ExerciseModel;
use Metrics\Model\LoginModel;

class ExerciseController extends Controller
{
    private $login;
    private $loginModel;
    private $exerciseModel;

    /**
     * ExerciceController constructor.
     * @param $login
     * @param $loginModel
     */
    public function __construct()
    {
        $this->login = new LoginController();
        $this->loginModel = new LoginModel();
        $this->exerciseModel = new ExerciseModel();
        parent::__construct();
    }

    public function index() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $this->view->bancas = $this->banca();
            $this->render('cadastrar');
        } else {
            $this->login->index();
        }
    }

    public function salvar() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            echo json_encode(array(
                "response" => $this->exerciseModel->salvar($_POST)
            ));
        } else {
            $this->login->index();
        }
    }

    public function listar() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $this->view->metricas = $this->exerciseModel->listar((int) $_SESSION['id_user']);
            $this->render('listar');
        } else {
            $this->login->index();
        }
    }

    public function formAtualizar() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            $this->view->bancas = $this->banca();
            $this->render('atualizar');
        } else {
            $this->login->index();
        }
    }

    public function atualizar() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            echo json_encode(array(
                "response" => $this->exerciseModel->atualizar($_POST)
            ));
        } else {
            $this->login->index();
        }
    }

    public function buscarDados() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            echo json_encode($this->exerciseModel->listarPorId((int) $_POST['id']));
        } else {
            $this->login->index();
        }
    }

    public function excluir() : void
    {
        if ($this->loginModel->verificarValidadeToken()) {
            echo json_encode(array(
               "result" => $this->exerciseModel->excluir((int) $_POST['id'])
            ));
        } else {
            $this->login->index();
        }
    }

    private function banca() : array
    {
        return $this->exerciseModel->banca();
    }
}