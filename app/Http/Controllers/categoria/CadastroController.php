<?php  
namespace vapj\Http\Controllers\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Http\Controllers\Controller;
use vapj\Categoria;
use vapj\Http\Requests\categoria\CadastroRequest;
class CadastroController extends Controller
{
    public function form(){
    	return view('categoria.cadastro');
    }

    public function cadastro(CadastroRequest $request){
    	$categoria = Categoria::create([
    		'nomeCategoria' => $request->input('nomeCategoria')
    		]);
    	return redirect('/cadastro/categorias');
    }
}

?>