<?php

include "../conexao.php";

$total = count($_GET);

if(isset($_GET['unidade1'])) {
for($i = 1; $i < $total + 1; $i++) {
	if($i == 1) $resposta = "a.unidade LIKE '".$_GET['unidade'.$i]."'";
	else $resposta .= " OR a.unidade LIKE '".$_GET['unidade'.$i]."'";
}

$sql = "SELECT count(*) as total FROM relatorios_funcionarios a WHERE (" . $resposta . ") AND desligado = 0";
$res = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($res);

$totalUsuarios = $row['total'];

$sql = "SELECT count(*) as total FROM relatorios_funcionarios a
        INNER JOIN relatorios_usuarios_ad b ON 
        a.matricula = b.matricula WHERE (" . $resposta . ") AND (a.desligado = 0)";
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

$sql = "SELECT count(*) AS total FROM relatorios_funcionarios a
        INNER JOIN relatorios_usuarios_ad b ON 
        a.matricula = b.matricula WHERE a.desligado = 0";
$res = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($res);

$totalDatasul = $row['total'];

$total = (100*$totalDatasul)/$totalUsuarios;
}
echo $sql;
?>


<script type="text/javascript">
	document.getElementById('preenchimento').style.width = <?=$total?> + "%";
	document.getElementById('valorUsuariosDatasul').innerHTML = <?=$totalDatasul?>;
	document.getElementById('valorUsuariosTotal').innerHTML = <?=$totalUsuarios?>;
</script>