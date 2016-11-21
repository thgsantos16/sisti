<?php

include "conexao.php";

if(!empty($_POST)) {

	if(!empty($_POST['mensagemFeedback'])) {
		$m['subject'] = 'Feedback - SisTI';	
		$m['to'] = 'desenvolvimento@pia.com.br';
		
		$m['message'] = $_POST['mensagemFeedback'];
		
		$m['headers'] = implode("\r\n",array(
								'From: Feedback SisTI <sisti@pia.com.br>',
								'Reply-To:'.$_SESSION['nome'].'<'.$_SESSION['usuario'].'@pia.com.br>',
								'Mime-Version: 1.0',
								'Content-Type: text/html; charset=utf-8',
								'Priority: normal',
								'X-Mailer: PHP/'.phpversion(),
								'X-Priority: 3'));;

			if(mail($m['to'],$m['subject'],$m['message'],$m['headers'])) {
				$resultado = "Feedback Enviado com Sucesso!";
			}
			else $resultado = "Falha ao enviar o seu Feedback!"; 
		
	}

}