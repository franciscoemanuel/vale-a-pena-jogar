function curtirLista(idLista){
$.ajax({
	url: vapj.urlCurtir,
	type: 'POST',
	dataType: 'json',
	data: {
			_token: window.Laravel.csrfToken,
			idLista: idLista,
	},
	beforeSend: function(e, el){
	    if (validaUsuario(e)){
	    	btn = $('#btn-curtir');
			btn.prop("disabled", true );
			btn.toggleClass('btn-success btn-default');
			btn.find('.texto').html(btn.hasClass('btn-default') ? "Curtir " : "Curtiu ");
			qtdCurtidas =  parseInt(btn.find('#qtdCurtidas').html()); 
			console.log(qtdCurtidas+1);
			btn.find('#qtdCurtidas').html(btn.hasClass('btn-default') ? qtdCurtidas-1 : qtdCurtidas+1)
		}
	},
	error: function(msg){
		console.log("Erro ao realizar operação");
	},
	complete: function(){
		$('#btn-curtir').prop( "disabled", false );
	}
});

}

function excluirLista(idlista){
$.ajax({
	url: vapj.urlExcluirLista,
	type: 'DELETE',
	dataType: 'json',
	data: {_token: window.Laravel.csrfToken},
	success: function(e){
		window.location = "/listas";
	}
});
}

function excluirComentario(url){
$.ajax({
	url: url,
	type: 'DELETE',
	dataType: 'json',
	data: {_token: window.Laravel.csrfToken},
	success: function(e){
		location.reload(true);
	}
});

}

$(function() {
$('#btn-excluirLista').confirmation({
    rootSelector: '#btn-excluirLista',
    title: 'Você tem certeza?',
    btnOkLabel: 'Sim',
    btnCancelLabel: 'Não',
    popout: true,
    onConfirm: function(e){
        idLista = $(this).parent().data('idlista');
        // console.log(idLista);
        excluirLista(idLista);
    }
});


$('#btn-excluirComentario').confirmation({
    rootSelector: '#btn-excluirComentario',
    title: 'Você tem certeza?',
    btnOkLabel: 'Sim',
    btnCancelLabel: 'Não',
    popout: true,
    onConfirm: function(e){
    	url = $(this).data('url');
        // console.log(url);
        excluirComentario(url);
    }
});

$("#btn-curtir").on('click', function(e) {
	e.preventDefault();
	idLista = $(this).data('idlista');
	curtirLista(idLista);
});

$("#comentarioForm").submit(function(e) {
	e.preventDefault();
	var formData =  $("#comentarioForm").serialize();
	$('#erro-comentario').html("");
	$("#div-comentario").removeClass("has-error");
	$.ajax({
		url: vapj.urlComentario,
		type: 'POST',
		data: formData,
		success: function(data) {            
		    location.reload(true);
		},error: function(data){
			var erro = jQuery.parseJSON(data.responseText);
			if (erro.comentario){
				$("#div-comentario").addClass("has-error");
				$('#erro-comentario').html(erro.comentario);
			}
		}
	});
});

$("#txt-comentario").on('input', function(event) {
	event.preventDefault();
	limite = 600;
	digitado = $(this).val().length;
	restante = limite - digitado;
	if (restante > 0) 
		$("#caracteres").html(restante);
	else
		$("#caracteres").html(0);
});;
});