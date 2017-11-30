<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 28/11/17
 * Time: 23:11
 */

namespace Metrics\Model;


class ExerciseModel extends Model
{
    public function salvar(array $data) : int
    {
        try {
           $this->getConection()
               ->prepare("INSERT INTO `metrics`.`exercicios` 
                                                        (
                                                        `banca`,
                                                        `data_registro`,
                                                        `quant_questoes`,
                                                        `quant_error`,
                                                        `quant_acertos`,
                                                        `user_id`
                                                        )
                                                        VALUES (                                                            
                                                            :banca,
                                                            :data_registro,
                                                            :quant_questoes,
                                                            :quant_error,
                                                            :quant_acertos,
                                                            :user_id
                                                        )")
               ->execute(array(
                    "banca" => $data['banca'],
                    "data_registro" => date("Y-m-d"),
                    "quant_questoes" => $data['totalQuestoes'],
                    "quant_error" => ((int) $data['totalQuestoes'] - (int) $data['totalAcertos']),
                    "quant_acertos" => $data['totalAcertos'],
                    "user_id" => $_SESSION['id_user']
               ));

           return 200;
        } catch (\Exception $e) {
          return -200;
        }
    }

    public function listar(int $id) : array
    {
        $data = $this->getConection()
            ->prepare("SELECT * FROM metrics.exercicios WHERE user_id = :id");

        $data->execute(array(
            "id" => $id
        ));

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listarPorId(int $id) : array
    {
        $data = $this->getConection()
            ->prepare("SELECT * FROM metrics.exercicios WHERE id = :id");

        $data->execute(array(
            "id" => $id
        ));

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function atualizar(array $dados) : int
    {
        try {
            $data = $this->getConection()
                ->prepare("
                UPDATE `metrics`.`exercicios`
                SET                
                `banca` = :banca,                
                `quant_questoes` = :quant_questoes,
                `quant_error` = :quant_error,
                `quant_acertos` = :quant_acertos                
                WHERE `id` = :id
            ");

            $data->execute(array(
                "id" => $dados['id'],
                "banca" => $dados['banca'],
                "quant_questoes" => $dados['totalQuestoes'],
                "quant_error" => ((int) $dados['totalQuestoes'] - (int) $dados['totalAcertos']),
                "quant_acertos" => $dados['totalAcertos']
            ));

            return 200;
        } catch (\Exception $e) {
            return -200;
        }
    }

    public function excluir(int $id) : int
    {
        try {
            $data = $this->getConection()
                ->prepare("DELETE FROM `metrics`.`exercicios` WHERE id = :id");

            $data->execute(array(
                "id" => $id
            ));

            return 200;
        } catch (\Exception $e) {
            return -200;
        }
    }

    public function banca() : array
    {
        $data = $this->getConection()
            ->prepare("SELECT * FROM metrics.bancas");

        $data->execute();

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }
}