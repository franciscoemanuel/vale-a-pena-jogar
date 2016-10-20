<?php  
namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroCategoriaRequest extends FormRequest
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
            'nomeCategoria' => 'required|max:120|unique:categorias,nomeCategoria'
        ];
    }

    public function messages(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'max' => 'O número máximo de caracteres para o campo :attribute foi excedido',
            'nomeCategoria.unique' => 'Esta categoria já foi cadastrada'
        ];
    }
}
?>