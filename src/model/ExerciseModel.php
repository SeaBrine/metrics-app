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
}