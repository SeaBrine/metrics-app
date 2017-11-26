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
}
