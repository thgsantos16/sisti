<style type="text/css">

	.appList {
	    padding: 16px 0;
	    display: inline-block;
	    width: 24%;
    	margin: 6px .5%;
	    color: #434343;
	    font-size: 20px;
	    height: auto;
	    vertical-align: top;
	    overflow: hidden;
	    z-index: 99;
	    position: relative;
	    box-sizing: border-box;
	    border: 1px solid #CCC;
	    cursor: pointer;
	    transition: all 0.43s;
	    -o-transition: all 0.43s;
	    -moz-transition: all 0.43s;
	    -webkit-transition: all 0.43s;
	}

	.appList:nth-child(even) {
	    background: #FFF;
	}

	div.appList:hover {
	    color: #FFF;
	    background: #13293e;
	    box-shadow: 1px 1px 7px #555;
	}

	div.appList:hover .imgUsuario { 
	    border: 1px solid #FFF;
	}


	div.appList:hover .att { 
	    opacity: .61;
	}

	div.appList:hover .att:hover { 
	    opacity: 1;
	}

</style>

<nav>

<?php

include_once "../conexao.php";

	$sqlProc = "SELECT b.* FROM relatorios_usuarios_an a 
	LEFT JOIN relatorios_areas_negocio b ON 
	a.id_area = b.id
	WHERE a.matricula = '".$_POST['ultimo']."'";
	$resProc = sqlsrv_query($con, $sqlProc);
	//echo $sqlProc;
	$existe = sqlsrv_has_rows($resProc);


if($existe) {
	
	 while($rowProc = sqlsrv_fetch_array($resProc)) {
		?><a target="_blank" href='areas-negocio/<?=$rowProc['link'];?>'><div class='imagem' style="background-image: url('./img/thumb_<?=$rowProc['img'];?>')"></div><span><?=$rowProc['nome'];?></span></a><?php }

?>

</nav>

<?php

}

else echo "<p>Nenhuma Área de Negócio.</p>";
