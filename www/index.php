<!DOCTYPE html>
<html lang="pt-br">
<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <title>CRUD-Docker-PHP-MySql</title>
</head>
<body>
<?php 
require 'vendor/autoload.php';
$registros = new src\modelo\ConsultaCurl();
$acao      = $_GET['pag']    ?: false;
$codigo    = $_GET['codigo'] ?: false;
$variaveis = $_POST          ?: false;
unset($_GET);
unset($_POST);
// --- >
if($acao == "formulario"){

  include_once ('formulario.php');

}elseif($acao == "incluirRegistro"){

 
  $resultado =  json_decode($registros->postIncluir($variaveis)->getResultado());
  echo '<script>alert("'.$resultado->mensagem.'")</script>';
  include_once ('listar.php');

}elseif($acao == "alterarRegistro"){

 $registro = $registros->getLista($codigo)->getResultado();
 $registro = array_shift(json_decode($registro));
 include_once ('formulario_alterar.php');
         
}elseif($acao == "alterarRegistro2"){

  $resultado = json_decode($registros->putAlterar($variaveis)->getResultado());
  echo '<script>alert("'.$resultado->mensagem.'")</script>';
  include_once ('listar.php');       


}elseif($acao=="apagarRegistro"){
  
  $registros->deleteExcluir($codigo)->getResultado();
  include_once ('listar.php');

} else {
      
  include_once ('listar.php');

}       

?> 
<p></p>
<div class="justify-content-center align-items-center row">   
  <div class="btn-group mr-2" role="group" >
    <button type="button" class="btn btn-secondary" id="botaoIncluir">NOVO REGISTRO</button>&nbsp;
    <button type="button" class="btn btn-secondary" id="botaoListar">LISTAR</button>

  </div>


</div>    
<!-- JavaScript (Opcional) -->
<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<script>

$("#botaoIncluir").click(function(){
   window.location = "?pag=formulario";

 });

$("#botaoListar").click(function(){
   window.location = "?pag=";

});

 $("#botaoSubmit").click(function(){

   if(!$("#inputNome").val()){
    alert("Favor preencher o nome!");
    $("#inputNome").focus();   
  }else if(!$("#inputHobby").val()){
    alert("Favor preencher o Hobby!");
    $("#inputHobby").focus();   
}else if(!$("#inputDataNascimento").val()){
    alert("Favor preencher o data de nascimento!");
    $("#inputDataNascimento").focus();   


  }else{

    $("#form").submit();
  }

});

  


</script>


