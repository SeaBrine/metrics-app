<?php
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 16:06
 */

require_once '../vendor/autoload.php';

if (!isset($_SESSION)) {
    session_start();
}

$route = new \Metrics\Route();