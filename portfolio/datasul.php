<div><div id="usuariosDatasul">Usuários Datasul: <span id="valorUsuariosDatasul"><?=$totalDatasul;?></span></div>
<div id="usuariosTotal">Total de Funcionários: <span id="valorUsuariosTotal"><?=$totalUsuarios;?></span></div></div>

<div id="unidades">
<h3>Unidades</h3>

<?php
$sql = "SELECT * FROM relatorios_listas WHERE tipo = 21";
$res = sqlsrv_query($con, $sql);

$i = 0;
while($row = sqlsrv_fetch_array($res)) {
	$unidade[$i] = $row['nome'];
	$i++;
}

sort($unidade);

for($j = 0; $j < count($unidade); $j++) {

	$explodir = explode(".", $unidade[$j]);
	$numero = $explodir[0];

?>


<label><input type="checkbox" onchange="checkUnidade()" value="<?=$numero?>" class="checkUnidade" name="unidade<?=$numero?>" id="unidade<?=$numero?>"> <?=$unidade[$j]?></label>

<?php } ?>
	
</div><div id="centrosCusto">
<h3>Centros de Custo</h3>

Selecione uma Unidade.
	
</div>



<script type="text/javascript">

function checkUnidade() {
	var unidade = document.getElementsByClassName('checkUnidade');
	var y = 1;
	for(var x = 0; x < unidade.length; x++) {
		if(y == 1 && unidade[x].checked == true) {
			var resultado = "unidade1=" + unidade[x].value;
			y++;
		}
		else if(unidade[x].checked == true) {
			resultado += "&unidade" + y + "=" + unidade[x].value;
			y++;
		}
	}

	$.post("../dinamicos/portfolio-servico.php?"+resultado, {usu: "70"}, function(resposta) {
       // Coloca a resposta na DIV
       $("#resultadosCheck").html(resposta);
   
    });

	$.post("../dinamicos/portfolio-servico2.php?"+resultado, {usu: "70"}, function(resposta) {
       // Coloca a resposta na DIV
       $("#centrosCusto").html(resposta);
   
    });
}



function checkcc() {
	var cc = document.getElementsByClassName('checkcc');
	var y = 1;
	for(var x = 0; x < cc.length; x++) {
		if(y == 1 && cc[x].checked == true) {
			var resultado = "cc1=" + cc[x].value;
			y++;
		}
		else if(cc[x].checked == true) {
			resultado += "&cc" + y + "=" + cc[x].value;
			y++;
		}
	}

	$.post("../dinamicos/centros-custo.php?"+resultado, {usu: "70"}, function(resposta) {
       // Coloca a resposta na DIV
       $("#resultadosCheck").html(resposta);
   
    });
}


	
</script>