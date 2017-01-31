<?php

include_once "./conexao.php";

$sql = "SELECT a.*, b.logon FROM relatorios_funcionarios a
        LEFT JOIN relatorios_usuarios_ad b ON
        a.matricula = b.matricula WHERE a.desligado = 1 AND b.ativo = 1";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)) {

?><div class="alertaSistema">

<div class="criticidade"></div>

<div class="conteudoAlerta">
	<div class="tituloAlerta">Usuário Desligado com AD Ativo | <?=$row['nome']?> <span class="dataAlerta"><?php if(!empty($row['dataDemissao'])) echo "- ".$row['dataDemissao']->format('d/m/Y')?></span></div>
	<div class="descricaoAlerta">É necessário apenas <strong>Desativar</strong> o Usuário <strong class="navUser" data-cod="<?=$row['matricula']?>"><?=$row['nome']?></strong> dentro da Interface do AD (<cite>Não excluir o Usuário do Sistema, apenas marcar como Ativo: Não</cite>).</div>
	<!--<a href="http://suporte.pia.com.br/ti/front/user.form.php?id=<?=$rowAD['id']?>" target="_blank" class="linkAlerta">Corrigir</a>-->
</div>

<!--<div class="excluirAlerta">X</div>-->

</div><?php }   ?>

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