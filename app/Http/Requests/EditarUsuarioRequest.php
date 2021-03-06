<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditarUsuarioRequest extends FormRequest
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
           'nomeUsuario' => "required|max:40|unique:usuarios,nomeUsuario,$this->idUsuario,idUsuario",
           'emailUsuario' => "required|max:120|email|unique:usuarios,emailUsuario,$this->idUsuario,idUsuario",
           'senhaUsuario' => 'sometimes|min:6|max:14|confirmed',
           'senhaUsuario_confirmation' => 'sometimes',
           'nomeCompletoUsuario' => 'required|max:120',
           'sexo' => 'required',
           'dataNascimentoUsuario' => 'required|date_format:d/m/Y'
       ];
    }

    public function messages(){
        return [
            'required' => 'o campo :attribute é obrigatório',
            'senhaUsuario.min' => 'A senha deve ter entre 6 a 14 caracteres',
            'email' => 'Insira um e-mail válido',
            'senhaUsuario.confirmed' => 'As senhas não são iguais',
            'senhaUsuario.max' => 'A senha deve ter entre 6 a 14 caracteres',
            'emailUsuario.unique' => 'Este e-mail já se encontra em nossa base de dados',
            'nomeUsuario.unique' => 'Este nome de usuário já está sendo usado',
            'max' => 'o campo :attribute atingiu o máximo de caracteres',
            'dataNascimentoUsuario.date_format' => 'Insira uma data válida no formato: dd/mm/aaaa'  
        ];
    }
}
