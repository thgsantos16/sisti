<?php

include "conexao.php";

if(!empty($_POST)) {
	
	if(!empty($_POST['novaDataAdmissao'])) {

		$sql = "UPDATE relatorios_funcionarios SET dataAdmissao = '".$_POST['dataAdmissao']."' WHERE matricula = '".$_POST['novaDataAdmissao']."'";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Usuário Atualizado', '".date("Y-m-d H:i:s")."', 'O Usuário foi Atualizado com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Usuário Atualizado com Sucesso!";
		}
	}
	
	if(!empty($_POST['hiddenUsuarioTerceiro'])) {

		$sql = "INSERT INTO relatorios_terceiros_funcionarios (id_empresa, nome) VALUES('".$_POST['hiddenUsuarioTerceiro']."', '".$_POST['usuarioTerceiro']."')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Terceiro - Usuário Inserido', '".date("Y-m-d H:i:s")."', 'O Usuário foi Inserido com Sucesso à Empresa Terceira!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Usuário Inserido com Sucesso!";
		}
	}
	
	if(!empty($_POST['terceiro'])) {

		$sql = "INSERT INTO relatorios_terceiros (nome, cnpj, link) VALUES ('".$_POST['nomeTerceiro']."', '".$_POST['cnpj']."', '".convertToUrl($_POST['nomeTerceiro'])."')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Terceiro Inserido', '".date("Y-m-d H:i:s")."', 'O Terceiro foi Inserido com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Terceiro Inserido com Sucesso!";
		}
	}
	
	if(!empty($_POST['hiddenUsuarioAreaNegocio'])) {

		$sql = "INSERT INTO relatorios_usuarios_an (id_area, matricula) VALUES('".$_POST['hiddenUsuarioAreaNegocio']."', '".$_POST['usuarioAreaNegocio']."')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Área de Negócio - Usuário Inserido', '".date("Y-m-d H:i:s")."', 'O Usuário foi Inserido com Sucesso à Área!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Usuário Inserido com Sucesso!";
		}
	}

	
	if(!empty($_POST['novoUsuario'])) {

		$sql = "INSERT INTO relatorios_usuarios (nome, login, senha, acesso) VALUES('".$_POST['novoUsuario']."', '".$_POST['novoLogin']."', '".base64_encode(base64_encode($_POST['novoSenha']))."', '9')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Novo Usuário - Usuário Inserido', '".date("Y-m-d H:i:s")."', 'O Usuário foi Inserido com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);


		if($res) {
			$resultado = "Usuário Inserido com Sucesso!";
		}
	}
	
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
		$sql = "INSERT INTO relatorios_usuarios_ad (matricula, categoria, email, logon) VALUES('".$_POST['matricula']."', 'usuario', '".$_POST['emailRede']."', '".$_POST['usuarioRede']."')";
		$res = sqlsrv_query($con, $sql);

		$lastRes = sqlsrv_query($con, "SELECT SCOPE_IDENTITY()");
		$lastId = sqlsrv_fetch_array($lastRes)[0];

		$sql1 = "INSERT INTO relatorios_historico (nome, hora, descricao, id_usuario, sistema, id_item) VALUES ('Usuário de Rede Inserido', '".date("Y-m-d H:i:s")."', 'O Usuário de Rede foi Inserido com Sucesso!', '".$_SESSION['userId']."', '99', '".$lastId."')";
		$res1= sqlsrv_query($con, $sql1);

		$_POST['matriculaGlobal'] = $_POST['matricula'];


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