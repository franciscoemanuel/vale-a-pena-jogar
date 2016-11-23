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
use JavaScript;
class JogoController extends Controller
{

	//Mostra página com todos os jogos
	public function index(){
		$jogos = Jogo::paginate(21);
		return view ('jogo.index')->withJogos($jogos);
	}

	//Mostra a form de cadastro de jogos 
	public function create(){
		return view('jogo.cadastro');
	}

	//Cadastra o jogo com os parâmetros da requisição validados
	public function store(CadastroJogoRequest $request){
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

		return redirect('/jogos/cadastro');
	}

	//Mostra página do jogo especificado no parâmetro da função
	public function show($nomeJogo){
		$jogo = \vapj\Jogo::where('nomeJogo', $nomeJogo)->firstOrFail();
		$avaliacaoMedia = DB::table('usuario_jogo')->where('idJogo',$jogo->idJogo)->avg('avaliacao');
		$avaliacaoMedia = number_format(floatval($avaliacaoMedia), 1);
		$avaliacaoUsuario = \Auth::check() ? \Auth::user()->avaliacaoJogo($jogo->idJogo) : 0;
		$usuarioPossuiJogo = \Auth::check() ? \Auth::user()->possuiJogo($jogo->idJogo) : false;
		return view('jogo.jogo', array(
				"jogo" => $jogo,
				"avaliacaoMedia" => $avaliacaoMedia,
				"avaliacaoUsuario" => $avaliacaoUsuario,
				"usuarioPossuiJogo" => $usuarioPossuiJogo
			));
	}

	//Mostra página de edição do jogo
	public function edit(){
		//
	}

	//Edita o jogo especificado no parâmetro do método
	public function update(Request $request, $id){
		//
	}

	//Deleta o jogo especificado no parâmetro do método
	public function destroy($id){
		//
	}


}
