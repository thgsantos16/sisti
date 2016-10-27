/* Javascript Navegação */

$(document).ready(function() {
	$('#iniciar').click(function() {
		$('#sombra').fadeIn();
		$('#formBusca').fadeIn();
	});

	$('#sombra').click(function() {
		$('#sombra').fadeOut();
		$('.modal').fadeOut();
	});

	$('#profile').click(function() {
		var x = document.getElementsByTagName("nav");
		//alert("XIS: " + x[0].style.marginRight);
		if(x[0].style.marginRight != "0px") x[0].style.marginRight = "0px";
		else x[0].style.marginRight = "-21%";
	});


    $("#equipamentos").click(function() {
    	//alert("AQUI!");

    	var elementos = document.getElementsByClassName("aba");
    	
	for (var x = 0; x < elementos.length; x++) {
		elementos[x].className = "aba";
	}

	this.className = "aba selecionado";

	var ultimo = this.dataset.cod;

        $("#dinamico").html('<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>');

        // Faz requisição ajax e envia o ID da Categoria via método POST
        $.post("dinamicos/equipamentos.php", {ultimo: ultimo}, function(resposta) {

           // Coloca a resposta na DIV
           setTimeout(function() { $("#dinamico").html(resposta); }, 700);
       
        });
    });

     $("#chamados").click(function() {
    	//alert("AQUI!");

    	var elementos = document.getElementsByClassName("aba");
    	
	for (var x = 0; x < elementos.length; x++) {
		elementos[x].className = "aba";
	}

	this.className = "aba selecionado";

	var ultimo = this.dataset.cod;

        $("#dinamico").html('<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>');

        // Faz requisição ajax e envia o ID da Categoria via método POST
        $.post("dinamicos/chamados.php", {ultimo: ultimo}, function(resposta) {

           // Coloca a resposta na DIV
           setTimeout(function() { $("#dinamico").html(resposta); }, 700);
       
        });
    });

	$("#recursos").click(function() {
    	//alert("AQUI!");

    	var elementos = document.getElementsByClassName("aba");
    	
	for (var x = 0; x < elementos.length; x++) {
		elementos[x].className = "aba";
	}

	this.className = "aba selecionado";

	var ultimo = this.dataset.cod;
	var logon = this.dataset.logon;

        $("#dinamico").html('<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>');

        // Faz requisição ajax e envia o ID da Categoria via método POST
        $.post("dinamicos/recursos.php", {ultimo: ultimo, logon: logon}, function(resposta) {

           // Coloca a resposta na DIV
           setTimeout(function() { $("#dinamico").html(resposta); }, 700);
       
        });
    });

});

function checkPesquisa() {
    var botaoPesquisa = document.getElementById("inputBuscaGeral").value;
    

    if(botaoPesquisa == "p:" && document.getElementById("inputBuscaGeralTipo").value != "programa") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").innerHTML = "Programa:";
        document.getElementById("inputBuscaGeralBefore").className = "ativo";
        document.getElementById("inputBuscaGeralTipo").value = "programa";
        document.getElementById("inputBuscaGeral").value = "";
    }
    

    if(botaoPesquisa == "u:" && document.getElementById("inputBuscaGeralTipo").value != "programa") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").innerHTML = "Usuário:";
        document.getElementById("inputBuscaGeralBefore").className = "ativo";
        document.getElementById("inputBuscaGeralTipo").value = "usuario";
        document.getElementById("inputBuscaGeral").value = "";
    }

    if((botaoPesquisa == ":q" || botaoPesquisa == ":esc" || botaoPesquisa == ":exit") && document.getElementById("inputBuscaGeralTipo").value != "") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").className = "";
        document.getElementById("inputBuscaGeralTipo").value = "";
        document.getElementById("inputBuscaGeral").value = "";

    }

}