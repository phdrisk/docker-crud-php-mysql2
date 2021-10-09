<?php
require '../vendor/autoload.php';


$con = \src\modelo\Conexao::get_instance();

//$sql = "DROP TABLE `developers`";
//mysqli_query($con,$sql);

$sql = "CREATE TABLE IF NOT EXISTS `developers` (
	codigo int(4) AUTO_INCREMENT,
	nome varchar(30) NOT NULL,
	sexo char(1),
	idade int(3),
	hobby varchar(50),
	datanascimento date,
	datainclusao date,
		PRIMARY KEY (codigo)
)";

#mysqli_select_db($con, "db") or die(mysqli_error($con));
mysqli_query($con,$sql);

$sql_d = "delete from developers";
mysqli_query($con,$sql_d) or die("erro ao deletar: ".mysqli_error($con));
	


$sql_i = "insert developers (nome,sexo,idade,hobby,datanascimento,datainclusao) values ('Luiz','M','47','ler','1974-07-12',CURRENT_DATE()), 
    ('Carlos','M','20','carros','2001-01-10',CURRENT_DATE()),
    ('Maria','F','35','viajar','1986-06-07',CURRENT_DATE()),
    ('Ana','F','25','alpinismo','1996-02-23',CURRENT_DATE())

    ";
echo "<h1>";
if(mysqli_query($con,$sql_i)){
	echo "REGISTROS INSERIDOS COM SUCESSO!";
  sleep(2);
  echo "<script>location.href='../index.php'</script>";

	}
else
	echo "ERRO AO INSERIR REGISTROS! ".mysqli_error($con);
echo "</h1>";

