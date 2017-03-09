function excluir(url){
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
$('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    title: 'Você tem certeza?',
    btnOkLabel: 'Sim',
    btnCancelLabel: 'Não',
    popout: true,
    onConfirm: function(e){
        url = $(this).data('url');
        excluir(url);
    }
});
});