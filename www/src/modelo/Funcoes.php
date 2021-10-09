<?php

namespace src\modelo;

/*
* Classe de Funcoes
* @autor Luiz Carlos Martins
* @email luiz_pr@hotmail.com/phdrisk@phdrisk.com.br
* @acess public
*/

class Funcoes{

	static $instance;
	private function __construct(){
	
		}
	  	
  /*
  * Função de retorno da instancia
  * @access public static
  * @return instanceMetodo
  */

	public static function get_instance()
		{
		/*
		* CASO O OPT FOR TRUE FORCA UMA NOVA INSTANCIA
		*/	
		if(!isset(self::$instance) || $opt == true)
			{	
		
			self::$instance = new Funcoes();
			}
		return 	self::$instance;
		}

  /*
  * Função que corrig a data para formato em portugues
  * @access public static
  * @param date $data
  * @return date
  */

    public static function corrigirData($data){

    	if(list($ano,$mes,$dia) = explode("-",$data)){

    		$data = "{$dia}/{$mes}/{$ano}";
    	}
        
        return $data;

    }
    
	/*
	* Função para calcular a diferenca entre anos de duas datas
	* @acess public
	* @param Date
	* @return String/Integer
	*/

	public static function calcularData($data) {

       $dataAtual = date("Y-m-d");
       $diferenca = strtotime($dataAtual) - strtotime($data) ;
       $anos = floor( $diferenca / ((60 * 60 * 24) * (30*12)));
       return $anos;

	}


}