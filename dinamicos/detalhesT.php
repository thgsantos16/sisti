<?php

include "../conexao.php";

$sql2 = "SELECT a.id as idTerceiro, a.nome, a.cnpj, a.link, b.* FROM relatorios_terceiros a
         LEFT JOIN relatorios_terceiros_detalhes b ON 
         a.id = b.id_terceiro WHERE a.id = '".$_POST['ultimo']."'";
$res2 = sqlsrv_query($con, $sql2);
$row2 = sqlsrv_fetch_array($res2);

?>

<h2 class="terceirosDetalhes">Nome: <?=$row2['nome'];?></h2>
<h3 class="terceirosDetalhes">CNPJ: <?=$row2['cnpj'];?></h3>

<h4 class="terceirosDetalhes">Endereço</h4>

<form action="<?=$row2['link'];?>" method="post" id="formDetalhes">
<input type="hidden" name="updateDetalhesTerceiro" value="<?=$row2['idTerceiro'];?>">

<label class="terceirosDetalhes">Endereço: <input name="endereco" placeholder="Endereço"></label><label class="terceirosDetalhes">Número: <input name="numero" placeholder="Número"></label><label class="terceirosDetalhes">Bairro: <input name="bairro" placeholder="Bairro"></label><label class="terceirosDetalhes">Cidade: <input name="cidade" placeholder="Cidade"></label><label class="terceirosDetalhes">Estado: <input name="estado" placeholder="Estado"></label>


<h4 class="terceirosDetalhes">Contato</h4>

<label class="terceirosDetalhes">Responsável: <input name="responsavel" placeholder="Responsável"></label><label class="terceirosDetalhes">Telefone: <input name="telefone" placeholder="Telefone"></label><label class="terceirosDetalhes">Celular: <input name="celular" placeholder="Celular"></label><label class="terceirosDetalhes">E-mail: <input name="email" placeholder="E-mail"></label><label class="terceirosDetalhes">Responsável Interno: <input name="responsavel_interno" placeholder="Responsável Interno"></label><a id="verResponsavelInterno" href="" target="_blank"></a>



<h4 class="terceirosDetalhes">Especificações Técnicas</h4>

<label class="terceirosDetalhes">Código Datasul: <input name="codigoDatasul" placeholder="Código Datasul"></label><label class="terceirosDetalhes">Contrato: <input name="contrato" placeholder="Contrato"></label><label class="terceirosDetalhes">Categoria do Serviço: <input name="categoriaServico" placeholder="Categoria do Serviço"></label><label class="terceirosDetalhes">Custo Hora: <input name="custoHora" placeholder="Custo Hora"></label>


<label class="terceirosDetalhes descricao">Descrição: <textarea name="descricao" placeholder="Descrição"></textarea></label>

<input type="submit" value="Salvar">

</form>