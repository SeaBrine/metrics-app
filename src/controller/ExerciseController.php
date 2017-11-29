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
}