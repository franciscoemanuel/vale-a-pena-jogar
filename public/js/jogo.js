function jaJogou(possuiJogo){
	$.ajax({
		method: 'POST',
		url: vapj.urlJogou,
		data: {
			idJogo: vapj.idJogo,
			usuarioPossuiJogo: possuiJogo,
			_token: window.Laravel.csrfToken,
		},
		beforeSend: function(e, el){
		    if (validaUsuario(e)){
				$('#btn-joguei').prop("disabled", true );
				$('#btn-joguei').toggleClass('btn-success btn-default');
				$('#estrelas').barrating('readonly', true);
			}
		},
		success: function(msg){
			/*console.log(msg);*/
			vapj.usuarioPossuiJogo = !possuiJogo;
			/*vapj.avaliacaousuario = possuiJogo ? null : avaliacao;*/
			if (!possuiJogo) 
				$("#btn-joguei").removeClass().addClass('btn btn-success');
			else
				$("#estrelas").barrating('clear');
			console.log("teste");
		},
		error: function(msg){
			console.log("Erro ao realizar operação");
		},
		complete: function(){
			$('#btn-joguei').prop( "disabled", false );
			$('#estrelas').barrating('readonly', false);
		}
	});
}

function excluirCritica(idCritica){
	console.log(vapj.urlCritica+'/'+idCritica);
	$.ajax({
		url: vapj.urlCritica+'/'+idCritica,
		method: 'DELETE',
		data: {_token: window.Laravel.csrfToken},
		success: function(e){
			console.log("Crítica excluida com sucesso!");
			location.reload(true);
		}
	})	
}

$(function() {
    $("#criticaForm").submit(function(e) {
    	e.preventDefault();
    	if (!vapj.usuarioPossuiJogo) jaJogou(false);
    	var formData =  $("#criticaForm").serialize();
    	$('#erro-nota').html("");
    	$("#div-nota").removeClass("has-error");
    	$('#erro-comentario').html("");
    	$("#div-comentario").removeClass("has-error");
    	$.ajax({
	        url: vapj.urlCritica,
	        type: 'POST',
	        data: formData,
	        success: function(data) {            
	            location.reload(true);
	        },error: function(data){
	        	var erro = jQuery.parseJSON(data.responseText);
	        	if (erro.nota){
	        		$("#div-nota").addClass("has-error");
	        		$('#erro-nota').html(erro.nota);
	        	}
	        	if (erro.comentario){
	        		$("#div-comentario").addClass("has-error");
	        		$('#erro-comentario').html(erro.comentario);
	        	}
	        }
    	});
    });
	
	$('#select-nota').barrating({
		theme: 'fontawesome-stars-o',
		allowEmpty: true,
		deselectable: true,
		emptyValue: 0
    });

    $("#select-nota").barrating('set', vapj.avaliacaousuario || 0);

	$("#btn-joguei").on('click', function(event){
		jaJogou(vapj.usuarioPossuiJogo);
	});

	$('[data-toggle=confirmation]').confirmation({
		rootSelector: '[data-toggle=confirmation]',
		title: 'Você tem certeza?',
		btnOkLabel: 'Sim',
		btnCancelLabel: 'Não',
		popout: true,
		onConfirm: function(e){
			var idCritica = $(this).data('idcritica');
			excluirCritica(idCritica);
		}
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