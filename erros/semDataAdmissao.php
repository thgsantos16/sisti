<?php

include_once "./con_glpi.php";

$sql = "SELECT * FROM relatorios_funcionarios WHERE dataAdmissao IS NULL";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)) {

?><div class="alertaSistema">

<div class="criticidade"></div>

<div class="conteudoAlerta">
	<div class="tituloAlerta">Usuário SEM Data de Admissão | <?=$row['nome']?></div>
	<div class="descricaoAlerta">É necessário apenas <strong>Adicionar</strong> ao Usuário <strong class="navUser" data-cod="<?=$row['matricula']?>"><?=$row['nome']?></strong> a data de Admissão na Empresa (<cite>É possível inserir essa data utilizando o botão "Corrigir"</cite>). A matricula do usuário é <strong><?=$row['matricula']?></strong>.</div>
	<a data-cod="<?=$row['matricula']?>" class="linkAlerta">Corrigir</a>
</div>

<!--<div class="excluirAlerta">X</div>-->

</div><?php } ?>


<form id="formRede" action="./alertas" method="post" class="modal" autocomplete="off">

<h3>Adicionar Data de Admissão</h3>

<input type="hidden" name="novaDataAdmissao" id="novaDataAdmissao" required>
<input placeholder="Data de Admissão" type="date" name="dataAdmissao" id="dataAdmissao" required>

<input type="submit" name="submitRede" id="submitRede">

</form>

<script>

$('.navUser').click(function(){
	//alert("AQUI");
	document.getElementById('inputBuscaGeral').value = "#" + this.dataset.cod;
	document.getElementById('buscaGeral').setAttribute('target', '_blank');
	document.getElementById('buscaGeral').submit();
	document.getElementById('buscaGeral').setAttribute('target', '_self');
	document.getElementById('inputBuscaGeral').value = "";
});


$('.linkAlerta').click(function(){
	document.getElementById('novaDataAdmissao').value = this.dataset.cod;
	$('#formRede').fadeIn();
	$('#sombraBranca').fadeIn();	
});

</script>

<?php

if(isset($resultado)) { ?>

<div id="resultadoAcao" class="modal"><?=$resultado;?></div>

<style>

div#sombraBranca {
	display: block;
}

</style>

<?php } ?>