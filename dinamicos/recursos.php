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


if(!empty($row["logon"]) && $row["logon"] != null) $rede = "sim";
else $rede = "nao";



include_once "../con_glpi.php";

$sqlGLPI = "SELECT a.* FROM glpi_users a WHERE a.name = '".$_POST['logon']."'";
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


$sqlcoletor = "SELECT * FROM relatorios_usuarios_ad WHERE matricula = '".$matricula."' AND ou LIKE 'OU=Usuarios Coletores,OU=OU_Users'";
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

	<a class="abaRecurso <?=$datasul;?>">Datasul <span><?php if($datasul == "sim") echo $row['usuarioDatasul']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$rede;?>">Rede <span><?php if($rede == "sim") echo $_POST['logon']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$glpi;?>">GLPI <span><?php if($glpi == "sim") echo $_POST['logon']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$fluig;?>">Fluig <span><?php if($fluig == "sim") echo $_POST['logon']; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$kw;?>">KW <span><?php if($kw == "sim") echo $matricula; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$coletor;?>">Coletores <span><?php if($coletor == "sim") echo str_replace('@pia.com.br', '', $rowColetor['logon']); else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso adicionar"><span>Adicionar Recurso</span>
	</a>

	<?php
	
}

else echo "<p>Nenhum Recurso foi Encontrado.</p>";
