<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarJogoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomeJogo' => "required|unique:jogos,nomeJogo,$this->idJogo,idJogo",
            'dataLancamento' => 'required|date_format:d/m/Y',
            'descricao' => 'required',
            'quantidadeJogadores' => 'required',
            'distribuidora' => 'required',
            'desenvolvedor' => 'required',
            'categorias' => 'required',
            'imagemJogo' => 'sometimes|image',
        ];
    }

    public function messages(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'dataLancamento.date_format' => 'Insira uma data válida no formato: dd/mm/aaaa',
            'imagemJogo.image' => 'Insira uma imagem válida',
            'nomeJogo.unique' => 'Este jogo já foi cadastrado'
        ];
    }
}
