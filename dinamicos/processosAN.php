<?php

include "../conexao.php";

$sql = "SELECT * FROM relatorios_processos_an WHERE id_area = ".$_POST['ultimo'];
$res = sqlsrv_query($con, $sql);
$existe = sqlsrv_has_rows($res);
//echo $sql;

if($existe) {
	?>

	<div class="ultimosChamados titulo">
		<div class="coluna1">ID</div><div class="coluna1">Nome</div><div class="coluna1">Descrição</div><div class="coluna1">Nome Externo</div>
	</div>

	<?php
	while($row = sqlsrv_fetch_array($res)) {
		?><a href="http://lanpiasoa.pia.com.br/equipamentos/?equipamento=<?=$row['id']?>&tipo=<?=$row['tipo']?>" target="_blank" class="ultimosChamados">
		<div class="coluna1"><?=$row['id']?></div><div class="coluna1"><?=$row['nome']?></div><div class="coluna1"><?=$row['descricao']?></div><div class="coluna1"><?=$row["nome_externo"];?></div>
	</a><?php
	}
}

else echo "<p>Nenhum Processo foi Encontrado.</p>";

?>

<form action="<?=$row['link']?>" method="post">
<input type="hidden" name="hiddenProcessoAreaNegocio" value="<?=$row['id'];?>">

<select name="ProcessoAreaNegocio" id="ProcessoAreaNegocio" required>
	<option value="" selected>Selecione um Processo</option>

	<?php
	$sql3 = "SELECT * FROM relatorios_processos";
	$res3 = sqlsrv_query($con, $sql3);

	sort($res3);

	$i = 0;

	while($row3 = sqlsrv_fetch_array($res3)){ 
		$usu[$i]['nome'] = $row3['nome'];
		$usu[$i]['id'] = $row3['id'];
		$i++;
	}

	sort($usu);

	for($i = 0; $i < count($usu); $i++) {

	?>

	<option value="<?=$usu[$i]['id']?>"><?=$usu[$i]['nome'];?></option>

	<?php } ?>
	
</select>

<input type="submit" value="Salvar">

</form>