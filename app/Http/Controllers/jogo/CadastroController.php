<?php

namespace vapj\Http\Controllers\jogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Http\Controllers\Controller;
use vapj\Jogo;
use vapj\Distribuidora;
use vapj\Desenvolvedor;
use vapj\Http\Requests\jogo\CadastroRequest;
use vapj\Categoria;
class CadastroController extends Controller
{

	//retorna a view de cadastro
	public function form(){
		$categorias = Categoria::all();
		$desenvolvedores = Desenvolvedor::all();
		$distribuidoras = Distribuidora::all();
		return view('jogo.cadastro')->withCategorias($categorias)->withDesenvolvedores($desenvolvedores)->withDistribuidoras($distribuidoras);
	}

	public function cadastro(CadastroRequest $request){
		//cadastra o jogo com os parâmetros da requisição
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
