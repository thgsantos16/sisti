<?php

include "../conexao.php";

$total = count($_GET);

if(isset($_GET['unidade1'])) {
for($i = 1; $i < $total + 1; $i++) {
	if($i == 1) $resposta = "unidade LIKE '".$_GET['unidade'.$i]."'";
	else $resposta .= " OR unidade LIKE '".$_GET['unidade'.$i]."'";
}

$sql = "SELECT count(*) as total FROM relatorios_funcionarios WHERE (" . $resposta . ") AND desligado = 0";
$res = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($res);

$totalUsuarios = $row['total'];

$sql = "SELECT count(*) as total FROM relatorios_funcionarios WHERE (" . $resposta . ") AND (usuarioDatasul NOT LIKE '' AND desligado = 0)";
$res = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($res);

$totalDatasul = $row['total'];

$total = (100*$totalDatasul)/$totalUsuarios;
}

else {
$sql = "SELECT count(*) as total FROM relatorios_funcionarios WHERE desligado = 0";
$res = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($res);

$totalUsuarios = $row['total'];

$sql = "SELECT count(*) as total FROM relatorios_funcionarios WHERE usuarioDatasul NOT LIKE '' AND desligado = 0";
$res = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($res);

$totalDatasul = $row['total'];

$total = (100*$totalDatasul)/$totalUsuarios;
}

?>


<script type="text/javascript">
	document.getElementById('preenchimento').style.width = <?=$total?> + "%";
	document.getElementById('valorUsuariosDatasul').innerHTML = <?=$totalDatasul?>;
	document.getElementById('valorUsuariosTotal').innerHTML = <?=$totalUsuarios?>;
</script>