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


include_once "../conexao_fluig.php";

$sqlFluig = "SELECT * FROM FDN_USERTENANT WHERE EMAIL = '".$_POST['logon']."@pia.com.br'";
$resFluig = sqlsrv_query($con3, $sqlFluig);
//echo $sqlFluig;
$existe3 = sqlsrv_has_rows($resFluig);
//echo $sql;

//echo $sqlFluig;

if($existe) $fluig = "sim";
else $fluig = "nao";

if(!empty($row["idKW"]) && $row["idKW"] != null) $kw = "sim";
else $kw = "nao";

	?>

	<a class="abaRecurso <?=$datasul;?>">Datasul <span><?php if($datasul == "sim") echo "Possui Acesso"; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$rede;?>">Rede <span><?php if($rede == "sim") echo "Possui Acesso"; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$glpi;?>">GLPI <span><?php if($glpi == "sim") echo "Possui Acesso"; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$fluig;?>">Fluig <span><?php if($fluig == "sim") echo "Possui Acesso"; else echo "Sem Acesso"; ?></span>
	</a><a class="abaRecurso <?=$kw;?>">KW <span><?php if($kw == "sim") echo "Possui Acesso"; else echo "Sem Acesso"; ?></span>
	</a>

	<?php
	
}

else echo "<p>Nenhum Recurso foi Encontrado.</p>";
