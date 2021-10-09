<?php
namespace src\modelo;
date_default_timezone_set('UTC');

/*
* Classe de requisiçao CURL
* @autor Luiz Carlos Martins
* @email luiz_pr@hotmail.com/phdrisk@phdrisk.com.br
* @acess public
*/

class ConsultaCurl{

    public $result;
    public $url_data = "http://ia.phdassets.net:8081/api/index.php/dev/";

    public function __construct(){}

    /*
    * Função que seta URL
    * @acess public
    * @param String $url
    * @return InstanceMethod
    */

    public function setUrl($url){

        $this->$url = $url;

     }
    /*
    * Função que inicializa o metodo CURL
    * @acess public
    * @param Array $parametros
    * @return InstanceMethod
    */

   private function init($parametros = false){

        $this->url  = !$parametros ? $this->url_data : $this->url_data.$parametros;
        $this->ch   = curl_init();
        curl_setopt( $this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        return $this;        
        
   }
    /*
    * Função que executar, pega o erro, e fecha o metodo CURL
    * @acess public
    * @param Date
    * @return InstanceMethod
    */

   private function close(){
   
        $this->result  = curl_exec($this->ch);
        $this->error   = curl_error($this->ch);
        curl_close($this->ch);
        return $this;

   }
    /*
    * Função de Listagem atraves do método GET 
    * @acess public
    * @param  String $codigo
    * @return InstanceMethod
    */
    public function getLista($codigo=false){

      $this->init($codigo);  
      curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
      $this->close();
      return $this;
    } 
    /*
    * Função de Listagem atraves do método GET com passagem de parametros
    * @acess public
    * @param  Array $parametros
    * @return InstanceMethod
    */
    
    public function getListaParametros(Array $parametros){
      
      $this->init(false);
      curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "GET");
      curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $parametros);
      $this->close();
      return $this;
    } 

    /*
    * Função de Inclusao atraves do método POST
    * @acess public
    * @param  Array $parametros
    * @return InstanceMethod
    */

    
    public function postIncluir($variaveis){


        unset($variaveis['inputCodigo']);
        $parametros = $this->corrigirParametros($variaveis);

        $this->init($parametros);
        curl_setopt ($this->ch, CURLOPT_POST, 1);
        curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $parametros);
        $this->close();

        return $this;
    }

    /*
    * Função de Alteracao atraves do método PUT
    * @acess public
    * @param  Array $parametros
    * @return InstanceMethod
    */

    public function putAlterar($variaveis){
        
        // -->
        //print __FILE__."<br>";    print_r($variaveis); exit;


        $parametros = $this->corrigirParametros($variaveis);
        $this->init($parametros);
        
        //print $this->url;exit;
        curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
        //curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $parametros);
        $this->close();
        return $this;
    }

    /*
    * Função de Alteracao atraves do método PUT
    * @acess public
    * @param  String/Integer $codigo
    * @return InstanceMethod
    */

    public function deleteExcluir($codigo){

        $this->init($codigo);
        curl_setopt ($this->ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt ($this->ch, CURLOPT_POSTFIELDS, $codigo);
        $this->close();
        return $this;
    }

    /*
    * Função de captura do resultado do metodo CURL
    * @acess public
    * @return String
    */

    public function getResultado(){
        
        return $this->result;

    }

    /*
    * Função de captura do erro do metodo CURL
    * @acess public
    * @return String
    */


    public function getError(){
        
        return $this->error;
    }

    /*
    * Função para calcular a diferenca entre anos de duas datas
    * @acess public
    * @param Date
    * @return String/Integer
    */

    public function calcularData($data){

           $dataAtual = date("Y-m-d");
           $diferenca = strtotime($dataAtual) - strtotime($data) ;
           $anos = floor( $diferenca / ((60 * 60 * 24) * (30*12)));
           return $anos;

        }
    /*
    * Função para converter os dados do formulario para formato query
    * @acess public
    * @param Array $variaves
    * @return Query String
    */
     public function corrigirParametros($variaveis){
       
        if(isset($variaveis["inputDataNascimento"])){
            $variaveis["inputIdade"] = $this->calcularData($variaveis["inputDataNascimento"]);
        // --->
        foreach($variaveis as $chave => $valor){
              $parametros .= strtolower(substr($chave,5,strlen($chave)))."=".urlencode($valor)."&";          
        
            }
     
        $parametros = "?".substr($parametros,0,-1);

        }
       
        return $parametros;
     }   

}