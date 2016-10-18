<?php

namespace vapj\Http\Controllers\distribuidora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Controllers\Controller;
use vapj\Http\Requests;
use vapj\Distribuidora;
use vapj\Http\Requests\Distribuidora\CadastroRequest;
class CadastroController extends Controller
{
    public function form(){
    	return view('distribuidora.cadastro');
    }

    public function cadastro(CadastroRequest $request){
    	$distribuidora = Distribuidora::create([
    			'nomeDistribuidora' => $request->input('nomeDistribuidora')
    		]); 
    	return redirect('/cadastro/distribuidoras');
    }
}
