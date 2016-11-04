<?php

include "../conexao.php";

//echo "AQUI: ".$_POST['usu'];

?>

<div id='buscaDinamica' ng-app="buscaDinamica" ng-controller='ctrlBuscaDinamica'></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>

$(function () {
	var max = 0;
$.getJSON("private/usuarios.json", function(result){
	$("#buscaDinamica").html("");
    $.each(result, function(i, field){
    	if((field.nome.toLowerCase().indexOf("<?=$_POST['usu']?>") != '-1' || field.matricula.toLowerCase().indexOf("<?=$_POST['usu']?>") != '-1') && max < 7) {
	        $("#buscaDinamica").append("<div class='resultadosDinamicos' data-cod='" + field.matricula +"'>" + field.matricula + " - " + field.nome + "</div>");
	        max++;
	    }
    });
}).then(function() {

if(max == 0) $("#buscaDinamica").html("<div class='semResultados'>Nenhum Resultado Encontrado!</div>");

$('.resultadosDinamicos').click(function(){
	//alert("AQUI");
	document.getElementById('inputBuscaGeral').value = "#" + this.dataset.cod;
	document.getElementById('buscaGeral').submit();
});

});



});


var app = angular.module('buscaDinamica', []);

app.controller('ctrlBuscaDinamica', function($scope) {
    $scope.firstName= "teste";
    $scope.lastName= "Doe";
});

angular.bootstrap( 'div', ['buscaDinamica']);

</script>