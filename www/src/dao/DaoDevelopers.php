<?php
namespace src\dao;
/*
* Classe DAO
* @autor Luiz Carlos Martins
* @acess public
*/

class DaoDevelopers {

     public function __construct($conexao){ 	
      $this->conexao = $conexao; 
   }

  /*
  * Função de inclusao
  * @acess public
  * @param Query String/ $where
  * @return false/true
  */

   public function incluir($where){

      $sql = "insert into developers set {$where}"; 
      if(mysqli_query($this->conexao,$sql)){
      
         return true;
         
      }else{
      
      return false;

      }
   }

  /*
  * Função Dao de consulta
  * @acess public
  * @return false/registro
  */

   public function consultar(){

     $sql = "select * from developers";
     $query =  mysqli_query($this->conexao,$sql);
     if( mysqli_affected_rows($this->conexao)==0)
      return false;

   while($resultado = mysqli_fetch_assoc($query))
    $retorno[] = $resultado;

   return json_encode($retorno);

   }

  /*
  * Função Dao de consulta registro por codigo
  * @acess public
  * @param String/Integer $codigo
  * @return false/registro
  */

   public function consultarId($codigo){

     $sql = "select * from developers where codigo='{$codigo}'";
     $query =  mysqli_query($this->conexao,$sql);
     if( mysqli_affected_rows($this->conexao)==0)
        return false;
       // ---> 
     while($resultado = mysqli_fetch_assoc($query))
        $retorno[] = $resultado; 

     return json_encode($retorno);
   }

  /*
  * Função Dao de consulta registro via Query
  * @acess public
  * @param Array $filtro
  * @return false/registros
  */

   public function consultarParams($filtro){

       $sql = "select * from developers {$filtro}"; //print $sql; exit;
       $query =  mysqli_query($this->conexao,$sql);
       if( mysqli_affected_rows($this->conexao)==0)
        return 97;
       // ---> 
     while($resultado = mysqli_fetch_assoc($query))
        $retorno[] = $resultado; 

     return json_encode($retorno);
   }

  /*
  * Função Dao para alterar um registro
  * @acess public
  * @param String/Integer $codigo
  * @param Array $where
  * @return true/false
  */

   public function alterar($where){

      $sql = "update developers set {$where}";// print $sql;exit;
      if(mysqli_query($this->conexao,$sql))
         return true;

      return false;
   }


  /*
  * Função Dao exclui um registro
  * @acess public
  * @param String/Integer $codigo
  * @return true/false
  */

   public function excluir($codigo){

      $sql = "delete from developers where codigo='{$codigo}'"; //print $sql; exit;
      if(mysqli_query($this->conexao,$sql))
         return true;

      return false;
   }


}
