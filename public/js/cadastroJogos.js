$(function() {
    $(".select2DesenvolvedorAjax").select2({
        placeholder: "Selecione um desenvolvedor",
        language: "pt-BR",        
        ajax: {
            url: "/autocomplete/desenvolvedores",
            cache: true,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
q: params.term // search term
};
},
processResults: function (data) {   
    return {
        results: data
    };
},
cache: true
},
minimumInputLength: 1
});
    $(".select2DistribuidoraAjax").select2({
        placeholder: "Selecione uma distribuidora",      
        language: "pt-BR",  
        ajax: {
            url: "/autocomplete/distribuidoras",
            cache: true,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
q: params.term // search term
};
},
processResults: function (data) {   
    return {
        results: data
    };
},
cache: true
},
minimumInputLength: 1
});
    $(".select2CategoriaAjax").select2({
        placeholder: "Selecione uma ou mais categorias",
        language: "pt-BR",        
        ajax: {
            url: "/autocomplete/categorias",
            cache: true,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
    q: params.term // search term
};
},
processResults: function (data) {   
    return {
        results: data
    };
},
cache: true
},
minimumInputLength: 1
});
    $("#dataLancamento").datepicker({
        dateFormat: 'dd/mm/yy',
        changeYear: true,
        changeMonth: true,
        yearRange: "-100:+0",
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
}); 
