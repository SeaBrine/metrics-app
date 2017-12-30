<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 21:14
 */

namespace Metrics\Model;


class Model
{
    private $pdo;

    function __construct()
    {
        $this->pdo = new \PDO("mysql:host=banco:3306", $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }

    public function getConection() : ?\PDO
    {
        return $this->pdo;
    }
}
