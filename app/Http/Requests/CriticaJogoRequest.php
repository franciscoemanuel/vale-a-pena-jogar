<?php  
namespace vapj\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriticaJogoRequest extends FormRequest
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
            /*'nota' => 'required',*/
            'comentario' => 'required|max:200'
        ];
    }

    public function messages(){
        return [
            /*'nota.required' => 'Dê sua nota',*/
            'comentario.required' => 'Insira sua crítica',
            'comentario.max' => 'O comentário tem um limite de 200 caracteres'
        ];
    }
}
?>