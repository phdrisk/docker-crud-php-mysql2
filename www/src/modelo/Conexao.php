<?php
namespace src\modelo;
class  Conexao {

   static $instance;
   private $host    = "db2";
   private $banco   = "phprs";
   private $usuario = "root";
   private $senha   = "phprs";


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
	  	
	// ----------------------------------------
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

