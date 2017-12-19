<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:58
 */

namespace Metrics\Model;


use Metrics\Controller\LoginController;

class HomeModel extends Model
{
    private $login;
    private $loginModel;

    function __construct()
    {
        $this->login = new LoginController();
        $this->loginModel = new LoginModel();
        parent::__construct();
    }

    public function mensal() : array
    {
        $data = $this->getConection()
            ->prepare("SELECT DATE_FORMAT(data_registro, '%M-%Y-%m') as mes, SUM(quant_questoes) as total_questoes, SUM(quant_acertos) as total_acerto, SUM(quant_error) as total_error FROM metrics.exercicios WHERE user_id = :id GROUP BY DATE_FORMAT(data_registro, '%M-%Y-%m')");

        $data->execute(array(
            "id" => $_SESSION['id_user']
        ));

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function semanal() : array
    {
        $data = $this->getConection()
            ->prepare("SELECT DATE_FORMAT(data_registro, '%w') as mes, SUM(quant_questoes) as total_questoes, SUM(quant_acertos) as total_acerto, SUM(quant_error) as total_error FROM metrics.exercicios WHERE user_id = :id GROUP BY DATE_FORMAT(data_registro, '%w')");

        $data->execute(array(
            "id" => $_SESSION['id_user']
        ));

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function anual() : array
    {
        $data = $this->getConection()
            ->prepare("SELECT DATE_FORMAT(data_registro, '%Y') as mes, SUM(quant_questoes) as total_questoes, SUM(quant_acertos) as total_acerto, SUM(quant_error) as total_error FROM metrics.exercicios WHERE user_id = :id GROUP BY DATE_FORMAT(data_registro, '%Y')");

        $data->execute(array(
            "id" => $_SESSION['id_user']
        ));

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function timeMonth(): array
    {
        $data = $this->getConection()
            ->prepare("SELECT id, DATE_FORMAT(data_registro, '%Y') as data, user_id, tempo FROM metrics.tempo WHERE user_id = :id");

        $data->execute(array(
           "id" =>  $_SESSION['id_user']
        ));

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createSeries(array $data) : array
    {
        $meses = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];

        $valores = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach ($data as $d) {
            $mes = explode("-", $d['mes']);

            if (in_array($mes[0], $meses)) {
                $cal = 0;
                foreach ($data as $v) {
                    if ($d['mes'] === $v['mes']) {
                        $cal += ((int) $d['total_acerto'] / (int) $d['total_questoes']) * 100;
                    }
                }

                $valores[$mes[2] - 1] = (double) number_format($cal, 0);
            }
        }

        return array(
            "meses" => $meses,
            "valores" => $valores
        );
    }
}