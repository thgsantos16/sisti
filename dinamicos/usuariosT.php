<?php

include "../conexao.php";

$sql2 = "SELECT * FROM relatorios_terceiros_funcionarios WHERE id_empresa = '".$_POST['ultimo']."'";
$res2 = sqlsrv_query($con, $sql2);
//echo $sql2;
$i = 0;

while($row2 = sqlsrv_fetch_array($res2)){ 
$i++;
?><div onclick="document.getElementById('buscaGeral').setAttribute('target', '_blank'); document.getElementById('inputBuscaGeral').value = '#<?=$row2['matricula']?>'; document.getElementById('buscaGeral').submit(); document.getElementById('buscaGeral').setAttribute('target', '_self'); document.getElementById('inputBuscaGeral').value = '';" class="appList"><div class='imgUsuario'></div><?=$row2['nome']?></div><?php }

 if($i == 0) echo "<p>Nenhum usuário cadastrado!</p>"; ?>

<form action="<?=$row['link']?>" method="post">
<input type="hidden" name="hiddenUsuarioTerceiro" value="<?=$row['id'];?>">

<input type="text" name="usuarioTerceiro" id="usuarioTerceiro" required placeholder="Nome do Funcionário">

<input type="submit" value="Salvar">

</form>