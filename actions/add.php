<?php

include "conexao.php";

if(!empty($_POST)) {
	
	if(!empty($_POST['idApp'])) {
		$idApp = $_POST['idApp'];
		$sql = "INSERT INTO relatorios_usuarios_aplicativos (id_aplicativo, id_usuario) VALUES('".$idApp."', '".$_POST['selectUser'.$idApp]."')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Aplicativo - Usuário Inserido', '".date("Y-m-d H:i:s")."', 'O Usuário foi Inserido com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Usuário Inserido com Sucesso!";
		}
	}
	
	if(!empty($_POST['emailRede'])) {
		$sql = "INSERT INTO relatorios_usuarios_ad (matricula, ou, email, logon) VALUES('".$_POST['matricula']."', 'OU=Usuarios Pia,OU=OU_Users', '".$_POST['emailRede']."', '".$_POST['usuarioRede']."@pia.com.br')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Usuário de Rede Inserido', '".date("Y-m-d H:i:s")."', 'O Usuário de Rede foi Inserido com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Usuário de Rede Inserido com Sucesso!";
			$_POST['matriculaGlobal'] = $_POST['matricula'];
		}
	}
	
	if(!empty($_POST['numeroRamal'])) {
		$sql = "UPDATE relatorios_funcionarios SET ramal = '".$_POST['numeroRamal']."' WHERE matricula = '".$_POST['matricula']."'";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Ramal Inserido', '".date("Y-m-d H:i:s")."', 'O Ramal foi Inserido com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Ramal Inserido com Sucesso!";
			$_POST['matriculaGlobal'] = $_POST['matricula'];
		}
	}
}