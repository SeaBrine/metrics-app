<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:58
 */

namespace Metrics\Model;


class LoginModel extends Model
{
    public function validLogin(array $params) : bool
    {
        $user = $params['user'];
        $password = md5($params['password']);

        $pdo = $this->getConection()->prepare(
            "SELECT count(id) as result FROM metrics.users_metrics WHERE user = :user AND password = :password"
        );

        $pdo->execute(array(
            "user" => $user,
            "password" => $password
        ));

        $result = $pdo->fetchAll(\PDO::FETCH_ASSOC);

        return $result[0]['result'] > 0;
    }

    public function gerarToken(array $paramsUser) : string
    {
        $pdo = $this->getConection()->prepare(
            "SELECT cpf, name, auth_id FROM metrics.users_metrics WHERE user = :user AND password = :password"
        );

        $pdo->execute(array(
            "user" => $paramsUser['user'],
            "password" => md5($paramsUser['password'])
        ));

        $result = $pdo->fetchAll(\PDO::FETCH_ASSOC);

        if (count($result, COUNT_NORMAL) > 0) {
            $token = md5($result[0]['cpf'].$result[0]['name'].date('Y-m-d H:i:s'));

            $pdo = $this->getConection()->prepare(
                "UPDATE metrics.auth SET token = :token WHERE id = :id"
            );

            $pdo->execute(array(
               "token" => $token,
                "id" => $result[0]['auth_id']
            ));

            return $token;
        } else {
            return "not valid";
        }
    }

    public function validarToken(string $token = "") : bool
    {
        $pdo = $this->getConection()->prepare(
            "SELECT count(id) as result FROM metrics.auth WHERE token = :token"
        );

        $pdo->execute(array(
            "token" => $token
        ));

        $result = $pdo->fetchAll(\PDO::FETCH_ASSOC);

        return $result[0]['result'] > 0;
    }

    public function loginSession(string $token) : void
    {
        $_SESSION['token'] = $token;
    }

    public function verificarValidadeToken() : bool
    {
        if (isset($_SESSION['token'])) {
            $result = $this->validarToken($_SESSION['token']);
            session_write_close();
            return $result;
        } else {
            return false;
        }
    }
}