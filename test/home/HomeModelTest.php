<?php
/**
 * Created by PhpStorm.
 * User: DanielSilva
 * Date: 26/11/17
 * Time: 17:00
 */

use Metrics\Model\HomeModel;
use PHPUnit\Framework\TestCase;

class HomeModelTest extends TestCase
{
    public function testSeClasseInstancia()
    {
        $model = new HomeModel();
        $this->assertInstanceOf("Metrics\\Model\\HomeModel", $model);
    }
}
