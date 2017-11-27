<?php
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 17:01
 */

use Metrics\Model\LoginModel;
use PHPUnit\Framework\TestCase;

class LoginModelTest extends TestCase
{
    public function testSeClasseInstancia()
    {
        $model = new LoginModel();
        $this->assertInstanceOf("Metrics\\Model\\LoginModel", $model);
    }

    public function testDeveraValidarLogin()
    {
        $model = new LoginModel();
        $params = array(
            "user" => "teste",
            "password" => "12345678"
        );

        $tokenValido = $model->validLogin($params);

        $this->assertTrue($tokenValido);
    }

    public function testDeveraValidarTokenLogin()
    {
        $model = new LoginModel();

        $tokenValido = $model->validarToken("c2e6c4f943f92913f341eced845d9c2c");

        $this->assertTrue($tokenValido);
    }
}
