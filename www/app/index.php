<?php


// -->
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../vendor/autoload.php';

$app        = new \Slim\App();


$conexao    = src\modelo\Conexao::get_instance();
$developers = new src\modelo\Developers($conexao);
// --> CONTROLADORES

$controlerIncluir =  function(Request $request, Response $response, array $args) use ($developers){


  $dbParams     = array("nome","sexo","idade","hobby","datanascimento");
  $params       = $request->getParams();
  unset($params['codigo']);
  $chavesParams = array_keys($params); 
  $cont         = 0; // --> verificador da qtde re params enviados
  $where        = '';

 // ---> VERIFICA SE O PARAMETRO EXISTE E CRIA A CONDICAO
  foreach($dbParams as $chave => $valor){
      

     if(in_array($chavesParams[$chave], $dbParams, true)){
       $cont++; 
 
       $where .= $chavesParams[$chave] . "='" .$params[$chavesParams[$chave]] . "', ";
     }
  }
  
  if ($cont != 4){

        $mensagem = array("mensagem"=>"Parametros Incorretos!","descricao"=> array("parametros permitidos"=> array( "parametros"=>"nome,sexo,hobby e datanascimento","Ex. datanascimento"=>array("Ex"=>"AAAAMMDD")))
      ,"erro"=>"i90","total"=>$cont);
           return $response->withJson($mensagem,400);



  }
  // --> CORRIGE A CONDICAO
  $where = substr($where,0,-2);
  
  // -->
  
  if($developers->inserir($where)){
     $mensagem = array("mensagem"=> "Registro Inserido com Sucesso!","status"=>200);
    //$response->getBody()->write("Registro Inserido!");
      return $response->withJson($mensagem,200);
    //$response->withStatus(200);
  }else{
     $mensagem = array("mensagem"=>"Erro ao Inserir!","status"=>"400","erro"=>"i99");
     return $response->withJson($mensagem,400);

    }

};




$controlerConsultar =  function(Request $request, Response $response, array $args) use ($developers){

   // --> CONSULTA POR PARAMENTRO
   if($params = $request->getParams()){
     if($resposta = $developers->consultarParams($params)){
      if($resposta == "97"){
       $mensagem = array("mensagem"=>"Codigo nao encontrado!","status"=>"404","erro"=>"c98");
       return $response->withJson($mensagem,404);
      }else{
        $response->getBody()->write($resposta);
        $response->withStatus(200);
       }
     }else{
        $mensagem = array("mensagem"=> array("parametros permitidos"=> array( "orderby"=>array("Exemplo:"=>"orderby=nome ou orderby=codigo"),
									      "buscar"=>array("Exemplo:"=>array("?buscarnome=Luiz","?buscarcodigo=2")),
									      "completo"=>array("Exemplo:"=>"?bucarnome=Luiz&orderby=codigo")
							))
			,"erro"=>"c98");
           return $response->withJson($mensagem,400);

     }

   }
   // ---> CONSULTA POR CODIGO
   elseif($args['codigo']){
    	if($resposta = $developers->consultarId((int)$args['codigo'])){
           $response->getBody()->write( $resposta );
           $response->withStatus(200);
         }else{
           $mensagem = array("mensagem"=>"Codigo nao encontrado!","status"=>"404","erro"=>"c99");
           return $response->withJson($mensagem,404);
         }
      }else{
    	$response->getBody()->write( $developers->consultar() );
        $response->withStatus(200);
       }
    return $response;
};


$controlerConsultarId =  function($id) use ($developers){

  print_r($args);
  print_r($request->getParams()); exit;

   
};

$controlerAlterar =  function(Request $request, Response $response, array $args) use ($developers){

  $dbParams = array("nome","sexo","idade","hobby","datanascimento");
  $params = $request->getParams();
  $codigo = $params['codigo'] ?: false;

 // ---> VERIFICA SE O PARAMETRO EXISTE E CRIA A CONDICAO
  foreach($params as $chave => $valor){
      
     if($chave == "codigo")
        continue;
     if(in_array($chave, $dbParams, true)){
       $where .= "$chave='".$params[$chave]."', ";
     }
  }
  // --> CORRIGE A CONDICAO
  $where = substr($where,0,-2);
  $where .= " where codigo='".$codigo."'";
  // -->
  if($developers->alterar($codigo,$where)){

    $mensagem = array("mensagem"=>"Registro Alterado!","status"=>"200");
    return $response->withJson($mensagem,200);

  }else{

     $mensagem = array("mensagem"=>"Codigo nao encontrado!","status"=>"400","erro"=>"a99");
     return $response->withJson($mensagem,400);

   }

};

$controlerApagar =  function(Request $request, Response $response, array $args) use ($developers){

  $codigo = $args['codigo'];
  if($developers->excluir($codigo)){
     $mensagem = array("mensagem"=>"Registro Apagado com Sucesso","status"=>"204");
     return $response->withJson($mensagem,204);
  }else{
     $mensagem = array("mensagem"=>"Registro nao encontrado","status"=>"400","erro"=>"x99");
     return $response->withJson($mensagem,400);
   }

};

$controlerIndex =  function(Request $request, Response $response, array $args) use ($developers){


};



$app->get('/', $controlerIndex);

// ---> POST ( inclusao )
$app->post('/dev/', $controlerIncluir);
// --> GET ( selecao ) 
$app->get('/dev/', $controlerConsultar);

$app->get('/dev/{codigo}', $controlerConsultar);

// --> DELETE ( exclusao )
//$app->delete('/dev/', $controlerApagar);
$app->delete('/dev/{codigo}', $controlerApagar);

// --> PUT ( alteracao )
$app->put('/dev/', $controlerAlterar);



$test =  function(Request $request, Response $response, array $args) use ($developers){
  print_r($args);
  print_r($request->getParams()); exit;

};


// -->
$app->run();
