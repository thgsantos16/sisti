<?php

include_once "./con_glpi.php";

$sql = "SELECT a.*, b.logon FROM relatorios_funcionarios a
        LEFT JOIN relatorios_usuarios_ad b ON
        a.matricula = b.matricula WHERE desligado = 1";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)) {


	$sqlGLPI = "SELECT * FROM glpi_users WHERE name = '".$row['logon']."' AND is_active = 1";
	$resGLPI = mysqli_query($con2, $sqlGLPI);
	$existe = mysqli_num_rows($resGLPI);

if($existe) {
	$rowGLPI = mysqli_fetch_array($resGLPI);

?><div class="alertaSistema">

<div class="criticidade"></div>

<div class="conteudoAlerta">
	<div class="tituloAlerta">Usuário Desligado com GLPI Ativo | <?=$row['nome']?> <span class="dataAlerta"><?php if(!empty($row['dataDemissao'])) echo "- ".$row['dataDemissao']->format('d/m/Y')?></span></div>
	<div class="descricaoAlerta">É necessário apenas <strong>Desativar</strong> o Usuário <strong class="navUser" data-cod="<?=$row['matricula']?>"><?=$row['nome']?></strong> na ferramenta de Suporte - TI (<cite>Não mover o Usuário para a Lixeira, apenas marcar como Ativo: Não</cite>). O ID do Usuário na ferramenta é <strong><?=$rowGLPI['id']?></strong>.</div>
	<a href="http://suporte.pia.com.br/ti/front/user.form.php?id=<?=$rowGLPI['id']?>" target="_blank" class="linkAlerta">Corrigir</a>
</div>

<!--<div class="excluirAlerta">X</div>-->

</div><?php } }  ?>


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