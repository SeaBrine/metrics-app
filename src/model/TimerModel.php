<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 03/12/17
 * Time: 18:23
 */

namespace Metrics\Model;


class TimerModel extends Model
{
    public function salvar(int $hora, int $minutos, int $segundos): int
    {
        try {
            $hora = $hora * 60;
            $minutos += (int) ($segundos / 60);

            $this->getConection()
                ->prepare("INSERT INTO metrics.tempo (user_id, data_registro, tempo) VALUES (:user, :registro, :tempo)")
                ->execute(array(
                    "user" => $_SESSION['id_user'],
                    "registro" => date("Y-m-d"),
                    "tempo" => ($hora + $minutos)
                ));

            return 200;
        } catch (\Exception $e) {
            return -200;
        }
    }
}