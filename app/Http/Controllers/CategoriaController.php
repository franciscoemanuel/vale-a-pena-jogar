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
    public function create(){
    	return view('admin.categorias.cadastro');
    }
    
    //Cadastra categoria com os parâmetros da requisição validados
    public function store(CadastroCategoriaRequest $request){
    	$categoria = Categoria::create([
    		'nomeCategoria' => $request->input('nomeCategoria')
    		]);
    	return redirect(route('admin.categorias'));
    }

    public function edit($id){
        $categoria = Categoria::where('idCategoria', $id)->firstOrFail();
        return view('admin.categorias.editar')->withCategoria($categoria);
    }

   
    public function update(Request $request, $id){
        $categoria = Categoria::where('idCategoria', $id)->firstOrFail();
        $categoria->nomeCategoria = $request->nomeCategoria;
        $categoria->save();
        return redirect(route('admin.categorias'));
    }

    
    public function destroy($id){
        $categoria = Categoria::find($id);
        $categoria->delete();
        return response()->json([], 200);
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

    public function adminIndex(Request $request){
        $categorias = new Categoria;

        $query = $request->has('busca') ? $request->busca : '';
        
        $categorias = $categorias->where('nomeCategoria', 'LIKE', "%$query%");

        // $categorias = $categorias->orderBy($ordem, $ascDesc);

        $categorias = $categorias->paginate(10)->appends([
            'busca' => $request->busca,
            // 'ordem' => $request->ordem
        ]);
        return view('admin.categorias.index')->withCategorias($categorias);
    }
}

?>