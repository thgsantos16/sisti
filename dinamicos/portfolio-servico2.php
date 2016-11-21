<h3>Centros de Custo</h3>
<?php

include "../conexao.php";

$total = count($_GET);

if(isset($_GET['unidade1'])) {
for($i = 1; $i < $total + 1; $i++) {
	if($i == 1) $resposta = "b.unidade LIKE '".$_GET['unidade'.$i]."'";
	else $resposta .= " OR b.unidade LIKE '".$_GET['unidade'.$i]."'";
}

$sql = "SELECT b.codigo, b.nome FROM relatorios_funcionarios a 
        LEFT JOIN relatorios_centro_custo b ON 
        a.centroCusto = b.codigo
        WHERE " . $resposta . " GROUP BY b.codigo, b.nome ORDER BY b.codigo";
$res = sqlsrv_query($con, $sql);

while($row = sqlsrv_fetch_array($res)){ 

?>

<label><input type="checkbox" checked onchange="checkcc()" value="<?=$row['codigo']?>" class="checkcc" name="cc<?=$row['codigo']?>" id="cc<?=$row['codigo']?>"> <?=$row['codigo']?> - <?=$row['nome']?></label>

<?php } } else { ?>

Selecione uma Unidade.

<?php } ?>