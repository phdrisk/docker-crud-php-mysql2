<?php 
namespace src\modelo;

/*
* Classe Modelo
* @autor Luiz Carlos Martins
* @email luiz_pr@hotmail.com/phdrisk@phdrisk.com.br
* @acess public
*/

class Developers{

  public function __construct($conexao){
  $this->conexao = $conexao;
  $this->daoDevelopers = new \src\dao\DaoDevelopers($conexao);
  }

  /*
  * Função de consulta registro 
  * @acess public
  * @return false/registros
  */

  public function consultar(){
      $retorno = $this->daoDevelopers->consultar();
      return $retorno;
  }
  
  /*
  * Função de consulta registro por codigo
  * @acess public
  * @param String/Integer $codigo
  * @return false/registro
  */

  public function consultarId($codigo){
      $retorno = $this->daoDevelopers->consultarId($codigo);
      return $retorno;
  }

  /*
  * Função de consulta registro via Query
  * @acess public
  * @param Array $paramns
  * @return false/registros
  */

  public function consultarParams($params){
      $filtronOn = false;
      foreach($params as $chave => $valor){
        if($chave == "buscarnome"){
          $filtro1 = "where  nome like '%{$valor}%' ";
          $filtronOn = true;
        }
       else if($chave == "buscaridade"){
          $filtro1 = "where  idade = '{$valor}' ";
          $filtronOn = true;
        }
        else if($chave == "orderby"){
          $filtro2 = "order by {$valor}";
          $filtronOn = true;
        }
      }


      if(!$filtronOn)
        return false;

      $filtro = $filtro1.$filtro2;
      $retorno = $this->daoDevelopers->consultarParams($filtro);
      return $retorno;
  }

  /*
  * Função de inserção
  * @acess public
  * @param Array $where
  * @return true/false
  */

  public function inserir($where){ //print __FILE__." ".$where;exit;
    
       return $this->daoDevelopers->incluir($where);
  
  }

  /*
  * Função que  alterar um registro
  * @acess public
  * @param String/Integer $codigo
  * @param Array $where
  * @return true/false
  */

  public function alterar($codigo,$where){ //print $codigo." ".$where;exit;

    if($consulta = $this->consultarId($codigo)){

         return $this->daoDevelopers->alterar($where);
      }

      return false;
    
  }

  /*
  * Função exclui um registro
  * @acess public
  * @param String/Integer $codigo
  * @return true/false
  */

  public function excluir($codigo){ //print "codigo=".$codigo." ".$where;exit;

    if($consulta = $this->consultarId($codigo)){
      
       return $this->daoDevelopers->excluir($codigo);
    }

    return false;
  }


}