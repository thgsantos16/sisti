<?php

include "../conexao.php";

$sql2 = "SELECT a.*, b.nome FROM relatorios_usuarios_an a
         LEFT JOIN relatorios_funcionarios b ON 
         a.matricula = b.matricula WHERE id_area = '".$_POST['ultimo']."'";
$res2 = sqlsrv_query($con, $sql2);
$i = 0;

while($row2 = sqlsrv_fetch_array($res2)){ 
$i++;
?><div onclick="document.getElementById('buscaGeral').setAttribute('target', '_blank'); document.getElementById('inputBuscaGeral').value = '#<?=$row2['matricula']?>'; document.getElementById('buscaGeral').submit(); document.getElementById('buscaGeral').setAttribute('target', '_self'); document.getElementById('inputBuscaGeral').value = '';" class="appList"><div class='imgUsuario'></div><?=$row2['nome']?><div class="titulo"><div class="att"></div><div class="att"></div><div class="att"></div></div></div><?php }

 if($i == 0) echo "Nenhum usuário cadastrado!"; ?>

<form action="<?=$row['link']?>" method="post">
<input type="hidden" name="hiddenUsuarioAreaNegocio" value="<?=$row['id'];?>">

<select name="usuarioAreaNegocio" id="usuarioAreaNegocio" required>
	<option value="" selected>Selecione um Usuário</option>

	<?php
	$sql3 = "SELECT * FROM relatorios_funcionarios";
	$res3 = sqlsrv_query($con, $sql3);

	sort($res3);

	$i = 0;

	while($row3 = sqlsrv_fetch_array($res3)){ 
		$usu[$i]['nome'] = $row3['nome'];
		$usu[$i]['matricula'] = $row3['matricula'];
		$i++;
	}

	sort($usu);

	for($i = 0; $i < count($usu); $i++) {

	?>

	<option value="<?=$usu[$i]['matricula']?>"><?=$usu[$i]['nome']?></option>

	<?php } ?>
	
</select>

<input type="submit" value="Salvar">

</form>