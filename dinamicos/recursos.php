<?php

include "../conexao.php";

$sql = "SELECT a.*, b.logon, c.id AS idKW FROM relatorios_funcionarios a 
	    LEFT JOIN relatorios_usuarios_ad b ON 
	    a.matricula = b.matricula 
	    LEFT JOIN relatorios_usuarios_kw c ON 
	    a.matricula = c.matricula 
	    WHERE a.matricula = ".$_POST['ultimo'];
$res = sqlsrv_query($con, $sql);
$existe = sqlsrv_has_rows($res);
//echo $sql;

if($existe) {
$row = sqlsrv_fetch_array($res);


//echo "AQUI: ".$row["usuarioDatasul"];
if(!empty($row["usuarioDatasul"]) && $row["usuarioDatasul"] != null && $row["nomeDatasul"] != "                                                   ") $datasul = "sim";
else $datasul = "nao";


$sqlrede = "SELECT * FROM relatorios_usuarios_ad WHERE matricula = '".$_POST['ultimo']."' AND categoria LIKE 'usuario' AND ativo = 1";
$resrede = sqlsrv_query($con, $sqlrede);

//print_r($con3);
$existeRede = sqlsrv_has_rows($resrede);

if($existeRede) {
	$rede = "sim";
	$rowRede = sqlsrv_fetch_array($resrede);
}
else $rede = "nao";


include_once "../con_glpi.php";

$sqlGLPI = "SELECT a.* FROM glpi_users a WHERE a.is_active = 1 AND a.name = '".$_POST['logon']."'";
$resGLPI = mysqli_query($con2, $sqlGLPI);
//echo $sqlGLPI;
$existe2 = mysqli_num_rows($resGLPI);
//echo $sql;

if($existe2) $glpi = "sim";
else $glpi = "nao";


include "../conexao_fluig.php";

//echo $_POST['logon'];

$sqlFluig = "SELECT * FROM FDN_USERTENANT WHERE EMAIL = '".$_POST['logon']."@pia.com.br'";
$resFluig = sqlsrv_query($con3, $sqlFluig);
//print_r($con3);
$existe3 = sqlsrv_has_rows($resFluig);
//echo $sql;

//echo $sqlFluig;

if($existe3) $fluig = "sim";
else $fluig = "nao";


$sqlcoletor = "SELECT * FROM relatorios_usuarios_ad WHERE matricula = '".$_POST['ultimo']."' AND categoria LIKE 'coletor' AND ativo = 1";
$rescoletor = sqlsrv_query($con, $sqlcoletor);
//print_r($con3);
$existe4 = sqlsrv_has_rows($rescoletor);
//echo $sql;

//echo $sqlcoletor;

if($existe4) {
	$coletor = "sim";
	$rowColetor = sqlsrv_fetch_array($rescoletor);
}
else $coletor = "nao";

if(!empty($row["idKW"]) && $row["idKW"] != null) $kw = "sim";
else $kw = "nao";

	?>

	<div id="mainRecursos">
	<a class="abaRecurso <?=$datasul;?>">Datasul <span><?php if($datasul == "sim") echo $row['usuarioDatasul']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$rede;?>">Rede <span><?php if($rede == "sim") echo $rowRede['logon']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$glpi;?>">GLPI <span><?php if($glpi == "sim") echo $_POST['logon']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$fluig;?>">Fluig <span><?php if($fluig == "sim") echo $_POST['logon']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$kw;?>">KW <span><?php if($kw == "sim") echo $_POST['ultimo']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$coletor;?>">Coletores <span><?php if($coletor == "sim") echo str_replace('@pia.com.br', '', $rowColetor['logon']); else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso adicionar"><span>Adicionar Recurso</span>
	</a></div>

	<?php
	
}

else echo "<p>Nenhum Recurso foi Encontrado.</p>";
