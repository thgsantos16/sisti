<?php

	include "conexao.php";

$sql = "SELECT matricula, nome FROM relatorios_funcionarios";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)) {
	$sql2 = "UPDATE relatorios_funcionarios SET nome = '".ucwords(strtolower($row['nome']))."' WHERE matricula = ".$row['matricula'];
	$res2 = sqlsrv_query($con, $sql2);
	echo $row['nome']."<br>";
}