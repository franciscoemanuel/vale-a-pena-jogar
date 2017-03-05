$(function() {
$(".select2JogosAjax").select2({
    placeholder: "Selecione um ou mais jogos",
    language: "pt-BR",        
    ajax: {
        url: "/autocomplete/jogos",
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

});