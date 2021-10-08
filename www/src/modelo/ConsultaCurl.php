<?php
namespace src\modelo;
date_default_timezone_set('UTC');
class ConsultaCurl{


    public $resultado;
    public $url_data = "http://ia.phdassets.net:9999/app/index.php/dev/";

    public function __construct(){
    }

    
    public function setUrl($url){

        $this->$url = $url;

     }

   private function init($parametros = false){
        $this->url  = !$parametros ? $this->url_data : $this->url_data.$parametros;
        $this->ch   = curl_init();
        curl_setopt( $this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        return $this;        
        
   }

   private function close(){
   
        $this->result  = curl_exec($this->ch);
        $this->error   = curl_error($this->ch);
        curl_close($this->ch);
        return $this;

   }

    public function getLista($codigo=false){

      $this->init($codigo);  
      curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
      $this->close();
      return $this;
    } 

    public function getListaCodigo($codigo){
      
      $this->init($codigo);
      curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
      $this->close();
      return $this;
    } 

    public function getListaParametros($parametros){
      
      $this->init($parametros);
      curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $parametros);
      $this->close();
      return $this;
    } 


    public function postIncluir($variaveis){
        $parametros = $this->corrigirParametros($variaveis);
        // -->
        $this->init($parametros);
        curl_setopt ($this->ch, CURLOPT_POST, 1);
        curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $parametros);
        $this->close();
        return $this;
    }

    public function putAlterar($variaveis){
        
        // -->
        $parametros = $this->corrigirParametros($variaveis);
        $this->init($parametros);
        curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $parametros);
        $this->close();
        return $this;
    }

    public function deleteExcluir($codigo){

        $this->init($codigo);
        curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $codigo);
        $this->close();
        return $this;
    }


    public function getResultado(){
        
        return $this->result;

    }

    public function getError(){
        
        return $this->error;
    }

    /*
    * FUNCAO QUE CALCULA A DIFERENCA ENTRE AS DATAS EM ANOS
    */
    public function calcularData($data){

           $dataAtual = date("Y-m-d");
           $diferenca = strtotime($dataAtual) - strtotime($data) ;
           $anos = floor( $diferenca / ((60 * 60 * 24) * (30*12)));

        
           return $anos;

        }
    /*
    * FUNCAO QUE CONERTE OS PARAMETROS EM UMA QUERY
    */
     public function corrigirParametros($variaveis){
       
        if(isset($variaveis["inputDataNascimento"])){
            $variaveis["inputIdade"] = $this->calcularData($variaveis["inputDataNascimento"]);
        // --->
        foreach($variaveis as $chave => $valor){
              $parametros .= strtolower(substr($chave,5,strlen($chave)))."=".$valor."&";          
        
            }
        $parametros = "?".substr($parametros,0,-1);
        }

        

        return $parametros;
     }   

}

/*

$t = new ConsultaCURL();

$parametros = array("inputNome"=>"luizcALORS","inputSexo"=>"M","inputHobby"=>"cacar","inputDataNascimento"=>"1900-09-09","inputCodigo"=>13);


//$x = $t->postIncluir("nome=luiz&sexo=M&hobby=cacar&datanascimento=1900-09-09")->getResul();

#$x = $t->postIncluir($parametros)->getResul();


//$x = $t->postAlterar($parametros)->getResul();
$x = $t->getLista(17)->getResul();

print_r($x);
*/

