<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroDesenvolvedorRequest extends FormRequest
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
            'nomeDesenvolvedor' => 'required|max:120|unique:desenvolvedores,nomeDesenvolvedor'
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O número máximo de caracteres para o campo :attribute foi excedido',
            'nomeDesenvolvedor.unique' => 'Este desenvolvedor já foi cadastrado'
        ];
    }
}

?>