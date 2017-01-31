<?php

$sql = "SELECT a.* FROM relatorios_aplicativos a 
		LEFT JOIN relatorios_usuarios_aplicativos b ON 
		a.id = b.id_aplicativo
		WHERE b.id_aplicativo = 11 AND b.id_usuario = ".$_SESSION['userId'];
		//echo $sql;
$res = sqlsrv_query($con, $sql);
$has = sqlsrv_has_rows($res);

if(!$has)  {

?>

<style type="text/css">

#alertasDinamicos {
	display: none;
}
	
</style>

<?php }

else {

include_once "./conexao.php";

$sql = "SELECT a.*, b.logon FROM relatorios_funcionarios a
        LEFT JOIN relatorios_usuarios_ad b ON
        a.matricula = b.matricula WHERE a.desligado = 1 AND b.ativo = 1";
$res = sqlsrv_query($con, $sql);

$i = 0;
while($row = sqlsrv_fetch_array($res)) $i++;


include_once "./con_glpi.php";

$sql = "SELECT a.*, b.logon FROM relatorios_funcionarios a
        LEFT JOIN relatorios_usuarios_ad b ON
        a.matricula = b.matricula WHERE desligado = 1";
$res = sqlsrv_query($con, $sql);

$j = 0;
while($row = sqlsrv_fetch_array($res)) {
	$sqlGLPI = "SELECT * FROM glpi_users WHERE name = '".$row['logon']."' AND is_active = 1";
	$resGLPI = mysqli_query($con2, $sqlGLPI);
	$existe = mysqli_num_rows($resGLPI);

if($existe) $j++;
}


$k = 0;
$sql = "SELECT * FROM relatorios_funcionarios WHERE dataAdmissao IS NULL";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)) $k++;

$total = $i + $j + $k;

if($total == 0) {
?>

<style type="text/css">

#alertasDinamicos {
	display: none;
}

#pDinamicos {
	display: block;
}
	
</style>

<?php } ?>

<span id="spanAlerta"><?=$total;?></span>

<?php } ?>