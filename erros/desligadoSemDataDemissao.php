<?php

include_once "./con_glpi.php";

$sql = "SELECT * FROM relatorios_funcionarios WHERE dataDemissao IS NULL AND desligado = 1";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)) {

?><div class="alertaSistema">

<div class="criticidade"></div>

<div class="conteudoAlerta">
	<div class="tituloAlerta">Usuário Desligado SEM Data de Demissão | <?=$row['nome']?></div>
	<div class="descricaoAlerta">É necessário apenas <strong>Adicionar</strong> ao Usuário <strong class="navUser" data-cod="<?=$row['matricula']?>"><?=$row['nome']?></strong> a data de Demissão na Empresa (<cite>É possível inserir essa data utilizando o botão "Corrigir"</cite>). A matricula do usuário é <strong><?=$row['matricula']?></strong>.</div>
	<a class="linkAlerta">Corrigir</a>
</div>

<!--<div class="excluirAlerta">X</div>-->

</div><?php } ?>


<script>

$('.navUser').click(function(){
	//alert("AQUI");
	document.getElementById('inputBuscaGeral').value = "#" + this.dataset.cod;
	document.getElementById('buscaGeral').setAttribute('target', '_blank');
	document.getElementById('buscaGeral').submit();
	document.getElementById('buscaGeral').setAttribute('target', '_self');
	document.getElementById('inputBuscaGeral').value = "";
});


</script>