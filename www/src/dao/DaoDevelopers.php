<?php
   namespace src\dao;
   class DaoDevelopers {

     public function __construct($conexao){ 	
      $this->conexao = $conexao; 
   }


     public function incluir($where){
      $sql = "insert into developers set {$where}"; //print $sql; exit;
      if(mysqli_query($this->conexao,$sql))
         return true;
      return false;
   }

   public function consultar(){
     $sql = "select * from developers";
     $query =  mysqli_query($this->conexao,$sql);
     if( mysqli_affected_rows($this->conexao)==0)
      return false;

   while($resultado = mysqli_fetch_assoc($query))
    $retorno[] = $resultado;

   return json_encode($retorno);

   }
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
    * Funcao que realiza a consulta atraves de parametros
    * PARAMS {codigo}
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


   public function alterar($where){
      $sql = "update developers set {$where}";// print $sql;exit;
      if(mysqli_query($this->conexao,$sql))
         return true;
      return false;
   }



   public function excluir($codigo){
      $sql = "delete from developers where codigo='{$codigo}'"; //print $sql; exit;
      if(mysqli_query($this->conexao,$sql))
         return true;
      return false;
   }


   }
