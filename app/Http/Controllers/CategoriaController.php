<?php

namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Categoria;
use vapj\Http\Requests\CadastroCategoriaRequest;
class CategoriaController extends Controller
{

	//Mostra a view de cadastro de categorias
    public function formCadastro(){
    	return view('categoria.cadastro');
    }
    
    //Cadastra categoria com os parâmetros da requisição validados
    public function cadastro(CadastroCategoriaRequest $request){
    	$categoria = Categoria::create([
    		'nomeCategoria' => $request->input('nomeCategoria')
    		]);
    	return redirect('/cadastro/categorias');
    }

    public function buscaCategoriasJson(Request $request){
        $query = $request->input('q');
        $categorias = Categoria::where('nomeCategoria','LIKE',"%$query%")->get(['idCategoria','nomeCategoria']);
        $json = [];
        foreach ($categorias as $categoria) {
            $json[] = array('id' => $categoria->idCategoria, 'text' => $categoria->nomeCategoria);
        }
        return response()->json($json);
    }
}

?>