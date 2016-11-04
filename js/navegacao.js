/* Javascript Navegação */

$(document).ready(function() {

    $(window).resize(function() {
         $(function() {
            var div = $('#profile');
            var width = 10 + div.width();
            
            div.css('height', width);
        });
    });

    $(function() {
        var div = $('#profile');
        var width = 10 + div.width();
        
        div.css('height', width);
    });

    $('#iniciar').click(function() {
        $('#sombra').fadeIn();
        $('#formBusca').fadeIn();
        document.getElementById('matriculaGlobal').focus();
    });

    $('.feedback').click(function() {
        $('#sombra').fadeIn();
        $('#formFeedback').fadeIn();
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

function ajuda() {
    $("#sombra").fadeIn();
    $("#ajudaBusca").fadeIn();
}

function checkPesquisa() {
    var botaoPesquisa = document.getElementById("inputBuscaGeral").value.toLowerCase();
    

    if(botaoPesquisa == "p:" && document.getElementById("inputBuscaGeralTipo").value == "") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").innerHTML = "Programa:";
        document.getElementById("inputBuscaGeralBefore").className = "ativo";
        document.getElementById("inputBuscaGeralTipo").value = "programa";
        document.getElementById("inputBuscaGeral").value = "";
    }
    

    if(botaoPesquisa == "u:" && document.getElementById("inputBuscaGeralTipo").value == "") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").innerHTML = "Usuário:";
        document.getElementById("inputBuscaGeralBefore").className = "ativo";
        document.getElementById("inputBuscaGeralTipo").value = "usuario";
        document.getElementById("inputBuscaGeral").value = "";
    }
    

    if(botaoPesquisa == "#" && document.getElementById("inputBuscaGeralTipo").value == "") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").innerHTML = "Matrícula:";
        document.getElementById("inputBuscaGeralBefore").className = "ativo";
        document.getElementById("inputBuscaGeralTipo").value = "matricula";
    }
    

    if(botaoPesquisa == "" && document.getElementById("inputBuscaGeralTipo").value == "matricula") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").innerHTML = "Matrícula:";
        document.getElementById("inputBuscaGeralBefore").className = "";
        document.getElementById("inputBuscaGeralTipo").value = "";
    }
    

    if(botaoPesquisa == ":help") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeral").value = "";
        ajuda.call()
    }

    if((botaoPesquisa == ":q" || botaoPesquisa == ":esc" || botaoPesquisa == ":exit") && document.getElementById("inputBuscaGeralTipo").value != "") {
        //alert("AQUI");
        document.getElementById("inputBuscaGeralBefore").className = "";
        document.getElementById("inputBuscaGeralTipo").value = "";
        document.getElementById("inputBuscaGeral").value = "";

    }

    if(botaoPesquisa.length > 3 && botaoPesquisa != ":exi" && document.getElementById("inputBuscaGeralTipo").value != "" && document.getElementById("inputBuscaGeralTipo").value != "matricula") {
        //alert("AQUI");
        
        $("#resultadosBusca").fadeIn();
        $("#resultadosBusca").html('<div class="spinner"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>');
        
        if(document.getElementById("inputBuscaGeralTipo").value == "programa") {
                // Faz requisição ajax e envia o ID da Categoria via método POST
            $.post("dinamicos/programas.php", {ultimo: botaoPesquisa}, function(resposta) {

               // Coloca a resposta na DIV
               setTimeout(function() { $("#resultadosBusca").html(resposta); }, 1000);
           
            });
        }

        if(document.getElementById("inputBuscaGeralTipo").value == "usuario") {
                // Faz requisição ajax e envia o ID da Categoria via método POST
            $.post("dinamicos/usuarios.php", {usu: botaoPesquisa}, function(resposta) {

               // Coloca a resposta na DIV
               setTimeout(function() { $("#resultadosBusca").html(resposta); }, 1000);
           
            });
        }

    }

    if(botaoPesquisa.length <= 3) $("#resultadosBusca").fadeOut();



}