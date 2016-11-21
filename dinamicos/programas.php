<?php

include "../conexao.php";

//echo $_POST['ultimo'];

?>

<div id='buscaDinamica' ng-app="buscaDinamica" ng-controller='ctrlBuscaDinamica'></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>

$(function () {
	var max = 0;
$.getJSON("http://lanpiasoa.pia.com.br/sisti/private/programas.json", function(result){
	$("#buscaDinamica").html("");
    $.each(result, function(i, field){
    	if((field.nome.indexOf("<?=$_POST['ultimo']?>") != '-1' || field.descricao.indexOf("<?=$_POST['ultimo']?>") != '-1' || field.nome_externo.indexOf("<?=$_POST['ultimo']?>") != '-1' || field.nome_menu.indexOf("<?=$_POST['ultimo']?>") != '-1') && max < 7) {
	        $("#buscaDinamica").append("<div data-nome='" + field.nome + "' class='resultadosDinamicos'>" + field.nome + " - " + field.descricao + "</div>");
	        max++;
	    }
    });
}).then(function() {

if(max == 0) $("#buscaDinamica").html("<div class='semResultados'>Nenhum Resultado Encontrado!</div>");

});

});


var app = angular.module('buscaDinamica', []);

app.controller('ctrlBuscaDinamica', function($scope) {
    $scope.firstName= "teste";
    $scope.lastName= "Doe";
});

angular.bootstrap( 'div', ['buscaDinamica']);

</script>