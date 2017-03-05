<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroListaRequest extends FormRequest
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
            "nomeLista" => "required",
            "descricaoLista" => "required|max:1200"
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            "descricaoLista.max" => "A descrição deve ter no máximo 1200 caracteres"
        ];
    }
}
