<?php

namespace vapj\Http\Controllers\desenvolvedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Http\Controllers\Controller;
use vapj\Desenvolvedor;
use vapj\Http\Requests\desenvolvedor\CadastroRequest;
class CadastroController extends Controller
{
    public function form(){
    	return view('desenvolvedor.cadastro');
    }

    public function cadastro(CadastroRequest $request){
    	$desenvolvedor = Desenvolvedor::create([
    		'nomeDesenvolvedor' => $request->input('nomeDesenvolvedor')
    		]);
    	return redirect('/cadastro/desenvolvedores');
    }
}
