function excluirCritica(idCritica){
	// console.log(vapj.urlCritica+'/'+idCritica);
	$.ajax({
		url: urlCritica+'/'+idCritica,
		method: 'DELETE',
		data: {_token: window.Laravel.csrfToken},
		success: function(e){
			console.log("Crítica excluida com sucesso!");
			location.reload(true);
		}
	})	
}
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