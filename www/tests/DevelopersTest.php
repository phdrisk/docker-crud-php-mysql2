<?php 
require 'vendor/autoload.php';

use \src\modelo\Developers;
use \src\dao\DaoDevelopers;


use PHPUnit\Framework\TestCase;

$conexao    = src\modelo\Conexao::get_instance();

 #$developer = new Developers($conexao);

class DevelopersTest  extends TestCase{


 public function testeDevelopers(){

  $developer = new Developers($conexao);

 }

 public function testeDaoDevelopers(){

  $daoDeveloper = new DaoDevelopers($conexao);

 }



}
