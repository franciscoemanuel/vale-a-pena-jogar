<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroRequest extends FormRequest
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
            'nomeUsuario' => 'required|max:255',
            'emailUsuario' => 'required|max:255|email|unique:usuarios,emailUsuario',
            'senhaUsuario' => 'required|min:6|confirmed',
            'senhaUsuario_confirmation' => 'required'
        ];
    }

    public function messages(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'senhaUsuario.min' => 'A senha precisa ter no mínimo 6 caracteres',
            'email' => 'Insira um e-mail válido',
            'senhaUsuario.confirmed' => 'As senhas não são iguais',
            'emailUsuario.unique' => 'Este e-mail já se encontra em nossa base de dados' 
        ];
    }
}
