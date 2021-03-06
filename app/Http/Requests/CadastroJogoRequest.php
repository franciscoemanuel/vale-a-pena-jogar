<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroJogoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

 
    public function rules()
    {
        return [
              'nomeJogo' => 'required|unique:jogos,nomeJogo',
              'dataLancamento' => 'required|date_format:d/m/Y',
              'descricao' => 'required',
              'quantidadeJogadores' => 'required',
              'distribuidora' => 'required',
              'desenvolvedor' => 'required',
              'categorias' => 'required',
              'imagemJogo' => 'sometimes|image'
        ];
    }

    public function messages(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'dataLancamento.date_format' => 'Insira uma data válida no formato: dd/mm/aaaa',
            'nomeJogo.unique' => 'Este jogo já foi cadastrado ou sugerido'
        ];
    }
}
