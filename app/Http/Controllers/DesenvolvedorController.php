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
    	return view('desenvolvedor.cadastro');
    }

    //Cadastra desenvolvedor com os parâmetros da requisição validados
    public function store(CadastroDesenvolvedorRequest $request){
    	$desenvolvedor = Desenvolvedor::create([
    		'nomeDesenvolvedor' => $request->input('nomeDesenvolvedor')
    		]);
    	return redirect('/desenvolvedores/cadastro');
    }

    public function edit(){
        //
    }

    
    public function update(Request $request, $id){
        //
    }

    
    public function destroy($id){
        //
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
}
