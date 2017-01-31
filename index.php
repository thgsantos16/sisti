<?php

session_start();

// Exibir Erros Oriundos do PHP
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

if(empty($_SESSION['usuario']) && !($_SESSION['acesso'] == 9 || $_SESSION['acesso'] == 2)) header("location: ./login.php");

else {


	include "conexao.php";
	include "function/urls.php";
	include "actions/add.php";
	include "actions/mail.php";
	include "private/validar.php";

	if(isset($_POST['inputBuscaGeral']) && substr($_POST['inputBuscaGeral'], 0, 1) == "#") $_POST['matriculaGlobal'] = substr($_POST['inputBuscaGeral'], 1); 

	if(empty($_POST['matriculaGlobal'])) {

		if(empty($_GET['url'])) {

			// Incluindo Cabeçalho Padrão
			include "includes/cabecalho.html";

			// Incluindo Corpo
			include "includes/conteudo.html";

			// Incluindo Scripts
			include "includes/scripts.html";

			// Incluindo rodapé Padrão
			include "includes/rodape.html";
		}

		else {
			// Incluindo Cabeçalho Padrão
			include "includes/cabecalhoUsuario.html";

			// Incluindo Corpo
			if($ln != "./") $_GET['url'] = $explodirUrl[2];
			
			if(file_exists("pages/conteudo".$_GET['url'].".html")) include "pages/conteudo".$_GET['url'].".html";
			else include "pages/conteudo404.html";
			
			// Incluindo Scripts
			include "includes/scripts.html";

			// Incluindo rodapé Padrão
			include "includes/rodapeUsuario.html";	
		}
	}

	else {
		if(!isset($_POST['inputBuscaGeral'])) $_SESSION['chamado'] = $_POST['matriculaGlobal'];
		// Incluindo Cabeçalho Padrão
		include "includes/cabecalhoUsuario.html";

		// Incluindo Corpo
		include "includes/conteudoUsuario.html";

		// Incluindo Scripts
		include "includes/scripts.html";

		// Incluindo rodapé Padrão
		include "includes/rodapeUsuario.html";		
	}
}

