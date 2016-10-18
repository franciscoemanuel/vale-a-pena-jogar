<?php

namespace vapj\Http\Requests\jogo;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
              'nomeJogo' => 'required',
              'dataLancamento' => 'required|date_format:d/m/Y',
              'descricao' => 'required',
              'quantidadeJogadores' => 'required',
              'distribuidora' => 'required',
              'desenvolvedor' => 'required',
              'categorias' => 'required'
        ];
    }

    public function messages(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'dataLancamento.date_format' => 'Insira uma data válida no formato: dd/mm/aaaa',
        ];
    }
}
