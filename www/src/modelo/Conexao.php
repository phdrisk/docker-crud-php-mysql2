<?php
namespace src\modelo;

/*
* Classe Conexao
* @autor Luiz Carlos Martins
* @email luiz_pr@hotmail.com/phdrisk@phdrisk.com.br
* @acess public
*/
class  Conexao {

   static $instance;
   private $host    = "db2";
   private $banco   = "phprs";
   private $usuario = "root";
   private $senha   = "phprs";

  /*
  * Função construtora 
  * @access private
  * @return void
  */

  	private function __construct()
		{
	
  		if(!$this->conexaoMysql = mysqli_connect(
  				$this->host,
				//$this->banco,
  				$this->usuario,
  				$this->senha
                                ,$this->banco  
				)
                   )
			{
			die("Erro na conexao Principal");
			}
         #        mysqli_select_db($this->conexaoMysql, "db");
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
		
			self::$instance = new Conexao();
			}
		return 	self::$instance->conexaoMysql;
		}

}

