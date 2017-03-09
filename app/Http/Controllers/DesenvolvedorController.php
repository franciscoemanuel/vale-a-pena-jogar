<?php

namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Desenvolvedor;
use vapj\Http\Requests\CadastroDesenvolvedorRequest;
class DesenvolvedorController extends Controller
{

	//Mostra a view de cadastro de desenvolvedores
    public function create(){
    	return view('admin.desenvolvedores.cadastro');
    }

    //Cadastra desenvolvedor com os parâmetros da requisição validados
    public function store(CadastroDesenvolvedorRequest $request){
    	$desenvolvedor = Desenvolvedor::create([
    		'nomeDesenvolvedor' => $request->input('nomeDesenvolvedor')
    		]);
    	return redirect(route('admin.desenvolvedores'));
    }

    public function edit($id){
        $desenvolvedor = Desenvolvedor::where('idDesenvolvedor', $id)->firstOrFail();
        return view('admin.desenvolvedores.editar')->withDesenvolvedor($desenvolvedor);
    }

    
    public function update(Request $request, $id){
        $desenvolvedor = Desenvolvedor::where('idDesenvolvedor', $id)->firstOrFail();
        $desenvolvedor->nomeDesenvolvedor = $request->nomeDesenvolvedor;
        $desenvolvedor->save();
        return redirect(route('admin.desenvolvedores'));
    }

    
    public function destroy($id){
        $desenvolvedor = Desenvolvedor::find($id);
        $desenvolvedor->delete();
        return response()->json([], 200);
    }

    public function buscaDesenvolvedoresJson(Request $request){
        $query = $request->input('q');
        $desenvolvedores = Desenvolvedor::where('nomeDesenvolvedor','LIKE',"%$query%")->get(['idDesenvolvedor','nomeDesenvolvedor']);
        $json = [];
        foreach ($desenvolvedores as $desenvolvedor) {
            $json[] = array('id' => $desenvolvedor->idDesenvolvedor, 'text' => $desenvolvedor->nomeDesenvolvedor);
        }
        return response()->json($json);
    }

    public function adminIndex(Request $request){
        $desenvolvedores = new Desenvolvedor;

        $query = $request->has('busca') ? $request->busca : '';
        
        $desenvolvedores = $desenvolvedores->where('nomeDesenvolvedor', 'LIKE', "%$query%");

        // $desenvolvedores = $desenvolvedores->orderBy($ordem, $ascDesc);

        $desenvolvedores = $desenvolvedores->paginate(10)->appends([
            'busca' => $request->busca,
            // 'ordem' => $request->ordem
        ]);

        return view('admin.desenvolvedores.index')->withDesenvolvedores($desenvolvedores);
    }
}
