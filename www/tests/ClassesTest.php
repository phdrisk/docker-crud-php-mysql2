<?php 
require 'vendor/autoload.php';

use \src\modelo\Developers;
use \src\modelo\ConsultaCurl;
use \src\modelo\Conexao;

use \src\dao\DaoDevelopers;




use PHPUnit\Framework\TestCase;



 #$developer = new Developers($conexao);

class ClassesTest  extends TestCase{

  /*
  * Classe Conexao
  */
    public function testConexao(){

       $conexao    = src\modelo\Conexao::get_instance();

    }

 // public function testConexao2(){

 //  $classe = $this->createMock(Conexao::class);
 //  $retorno = $classe->method('get_instance')->willReturn(true);
 //  $this->assertEquals($retorno,$classe::get_instance());


 // }


  /*
  * Classe Developers
  */
  
 public function testDevelopers(){

  $developer = new Developers($conexao);

 }

public function testRetorno(){

 $classe = $this->createMock(Developers::class); 
 $retorno = $classe->method('retorno')->willReturn("suiz");
 $this->assertEquals("luiz",$classe->retorno());

}

/*
 * Classe DaoDevelopers
 */
  
 public function testDaoDevelopers(){

  $daoDeveloper = new DaoDevelopers($conexao);
  
 }

/*
 * Classe ConsultaCurl
 */

 public function testCurl(){

   $stub = $this->createMock(ConsultaCurl::class);
   $stub->method('getResultado')->willReturn(true);
   $this->assertEquals(true,$stub->getResultado());


  }






// public function testxception(){

//     $this->expectException(InvalidArgumentException::class);

// }




}
