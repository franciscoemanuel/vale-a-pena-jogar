<?php

namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Jogo;
use vapj\Distribuidora;
use vapj\Desenvolvedor;
use vapj\Http\Requests\CadastroJogoRequest;
use vapj\Categoria;
class JogoController extends Controller
{

	//Mostra a view de cadastro de jogos 
	public function formCadastro(){
		$categorias = Categoria::all();
		$desenvolvedores = Desenvolvedor::all();
		$distribuidoras = Distribuidora::all();
		return view('jogo.cadastro')->withCategorias($categorias)->withDesenvolvedores($desenvolvedores)->withDistribuidoras($distribuidoras);
	}

	//Cadastra o jogo com os parâmetros da requisição validados
	public function cadastro(CadastroJogoRequest $request){
		
		$jogo = Jogo::Create([
				'nomeJogo' => $request->input('nomeJogo'),
				'dataLancamento' => $request->input('dataLancamento'),
				'descricao' => $request->input('descricao'),
				'quantidadeJogadores' => $request->input('quantidadeJogadores'),
				'idDistribuidora' => $request->input('distribuidora'),
				'idDesenvolvedor' => $request->input('desenvolvedor')
			]);
		
		//cadastra as categorias na tabela pivô
		$jogo->categorias()->sync($request->categorias, false);

		return redirect('/cadastro/jogos');
	}
}
