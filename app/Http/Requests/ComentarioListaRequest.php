<?php

namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComentarioListaRequest extends FormRequest
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
            "comentario" => "required|max:600"
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            "comentario.max" => "O comentário deve ter no máximo 600 caracteres"
        ];
    }
}
