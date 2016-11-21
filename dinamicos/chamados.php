<?php

include_once "../con_glpi.php";

	$sqlGLPI = "SELECT a.* FROM glpi_tickets a 
	LEFT JOIN glpi_tickets_users c ON 
	a.id = c.tickets_id
	LEFT JOIN glpi_users b ON 
	c.users_id = b.id
	WHERE b.name = '".$_POST['ultimo']."' AND a.is_deleted = 0 AND c.type = 1 ORDER BY a.id DESC LIMIT 16";
	$resGLPI = mysqli_query($con2, $sqlGLPI);
	//echo $sqlGLPI;
	$existe = mysqli_num_rows($resGLPI);
//echo $sql;

if($existe) {
	?>

	<div class="ultimosChamados titulo">
		<div class="coluna">ID</div><div class="coluna">Data de Abertura</div><div class="coluna">Assunto do Chamado</div>
	</div>

	<?php
	 while($rowGLPI = mysqli_fetch_array($resGLPI)) {
	 	$total++;
		$explodir = explode(" ", $rowGLPI['date']);
		$explodir2 = explode("-", $explodir[0]);
		$data = $explodir2[2]."/".$explodir2[1]."/".$explodir2[0];
		?><a href="http://suporte.pia.com.br/ti/front/ticket.form.php?id=<?=$rowGLPI['id']?>" target="_blank" class="ultimosChamados">
		<div class="coluna"><?=$rowGLPI['id']?></div><div class="coluna"><?=$data." - ".$explodir[1];?></div><div class="coluna"><?=$rowGLPI['name']?></div>
	</a><?php }
}

else echo "<p>Nenhum Chamado foi Aberto.</p>";
