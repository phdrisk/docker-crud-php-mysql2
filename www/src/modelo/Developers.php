<?php 
namespace src\modelo;

class Developers{

  public function __construct($conexao){
  $this->conexao = $conexao;
  $this->daoDevelopers = new \src\dao\DaoDevelopers($conexao);
  }
  public function consultar(){
      $retorno = $this->daoDevelopers->consultar();
      return $retorno;
  }
  public function consultarId($codigo){
      $retorno = $this->daoDevelopers->consultarId($codigo);
      return $retorno;
  }
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

  public function inserir($where){ //print __FILE__." ".$where;exit;
    
       return $this->daoDevelopers->incluir($where);
  
  }

  public function alterar($codigo,$where){ //print $codigo." ".$where;exit;

  if($consulta = $this->consultarId($codigo)){
       return $this->daoDevelopers->alterar($where);
    }

    return false;
  
  }

  public function excluir($codigo){ //print "codigo=".$codigo." ".$where;exit;
    if($consulta = $this->consultarId($codigo)){
       return $this->daoDevelopers->excluir($codigo);
    }

    return false;
  }

}
