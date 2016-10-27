<?php

$con2 = @mysqli_connect("10.1.10.206","wsdl","jjpP2nVSCNj6Jfdx");
if (!$con2) {
	$status = "Erro: Não foi possível conectar com o banco de dados!";
	echo $status;
	exit;

}
else {
	$db = mysqli_select_db($con2, 'glpi');
	if (!$db) {
		$status = "Erro: Conexão feita, mas a base de dados não foi encontrada...";
	echo $status;
	exit;
	}
}


// if($con && $db) $status = "Tudo certo!";
mysqli_set_charset($con2,"utf8");
mysqli_query($con2,"SET NAMES 'utf8'");
mysqli_query($con2,'SET character_set_connection=utf8');
mysqli_query($con2,'SET character_set_client=utf8');
mysqli_query($con2,'SET character_set_results=utf8');


?>