<?php

include "../conexao.php";

$sql = "SELECT b.*, c.nome AS nomeTipo, d.nome AS nomeMarca FROM relatorios_itens_responsaveis a 
	    INNER JOIN relatorios_equipamentos b ON 
	    a.id_item = b.id 
	    INNER JOIN relatorios_tipos c ON 
	    a.id_categoria = c.id 
	    INNER JOIN relatorios_listas d ON 
	    b.marca = d.id 
	    WHERE a.matricula = ".$_POST['ultimo'];
$res = sqlsrv_query($con, $sql);
$existe = sqlsrv_has_rows($res);
//echo $sql;

if($existe) {
	?>

	<div class="ultimosChamados titulo">
		<div class="coluna1">ID</div><div class="coluna1">Tipo</div><div class="coluna1">Marca</div><div class="coluna1">Modelo</div>
	</div>

	<?php
	while($row = sqlsrv_fetch_array($res)) {
		?><a href="http://lanpiasoa.pia.com.br/equipamentos/?equipamento=<?=$row['id']?>&tipo=<?=$row['tipo']?>" target="_blank" class="ultimosChamados">
		<div class="coluna1"><?=$row['id']?></div><div class="coluna1"><?=$row['nomeTipo']?></div><div class="coluna1"><?=$row['nomeMarca']?></div><div class="coluna1"><?=$row["modelo"];?></div>
	</a><?php
	}
}

else echo "<p>Nenhum Equipamento foi Encontrado.</p>";
