<?php

namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Distribuidora;
use vapj\Http\Requests\CadastroDistribuidoraRequest;
class DistribuidoraController extends Controller
{
	//Mostra a view de cadastro de distribuidoras
    public function create(){
    	return view('admin.distribuidoras.cadastro');
    }

    //Cadastra distribuidora com os parâmetros da requisição validados
    public function store(CadastroDistribuidoraRequest $request){
    	$distribuidora = Distribuidora::create([
    			'nomeDistribuidora' => $request->input('nomeDistribuidora')
    		]); 
    	return redirect(route('admin.distribuidoras'));
    }

    public function edit($id){
        $distribuidora = Distribuidora::where('idDistribuidora', $id)->firstOrFail();
        return view('admin.distribuidoras.editar')->withDistribuidora($distribuidora);
    }

    
    public function update(Request $request, $id){
        $distribuidora = Distribuidora::where('idDistribuidora', $id)->firstOrFail();
        $distribuidora->nomeDistribuidora = $request->nomeDistribuidora;
        $distribuidora->save();
        return redirect(route('admin.distribuidoras'));
    }

    
    public function destroy($id){
        $distribuidora = Distribuidora::find($id);
        $distribuidora->delete();
        return response()->json([], 200);
    }

    public function buscaDistribuidorasJson(Request $request){
        $query = $request->input('q');
        $distribuidoras = Distribuidora::where('nomeDistribuidora','LIKE',"%$query%")->get(['idDistribuidora','nomeDistribuidora']);
        $json = [];
        foreach ($distribuidoras as $distribuidora) {
            $json[] = array('id' => $distribuidora->idDistribuidora, 'text' => $distribuidora->nomeDistribuidora);
        }
        return response()->json($json);
    }

    public function adminIndex(Request $request){
        $distribuidoras = new Distribuidora;

        $query = $request->has('busca') ? $request->busca : '';
        
        $distribuidoras = $distribuidoras->where('nomeDistribuidora', 'LIKE', "%$query%");

        // $distribuidoras = $distribuidoras->orderBy($ordem, $ascDesc);

        $distribuidoras = $distribuidoras->paginate(10)->appends([
            'busca' => $request->busca,
            // 'ordem' => $request->ordem
        ]);
        return view('admin.distribuidoras.index')->withDistribuidoras($distribuidoras);
    }
}
