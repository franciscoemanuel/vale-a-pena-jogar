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
    public function formCadastro(){
    	return view('distribuidora.cadastro');
    }

    //Cadastra distribuidora com os parâmetros da requisição validados
    public function cadastro(CadastroDistribuidoraRequest $request){
    	$distribuidora = Distribuidora::create([
    			'nomeDistribuidora' => $request->input('nomeDistribuidora')
    		]); 
    	return redirect('/cadastro/distribuidoras');
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
}
