<?php

namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vapj\Http\Requests;
use vapj\Jogo;
use vapj\Distribuidora;
use vapj\Desenvolvedor;
use vapj\Http\Requests\CadastroJogoRequest;
use vapj\Http\Requests\EditarJogoRequest;
use vapj\Categoria;
use JavaScript;
use Image;
use Storage;
class JogoController extends Controller
{

	//Mostra página com todos os jogos
	public function index(Request $request){
		$jogos = new Jogo;

		$query = $request->has('busca') ? $request->busca : '';
		
		$ordem = $request->has('ordem') ? $request->ordem : 'notaMedia';

		$ascDesc = $ordem == "nomeJogo" ? 'asc' : 'desc';

		$jogos = $jogos->where('nomeJogo', 'LIKE', "%$query%");

		$jogos = $jogos->orderBy($ordem, $ascDesc);

		$jogos = $jogos->orderBy('numCriticas', 'desc');

		$jogos = $jogos->paginate(12)->appends([
			'busca' => $request->busca,
			'ordem' => $request->ordem
		]);

		return view ('jogo.index')->withJogos($jogos);
	}

	//Mostra a form de cadastro de jogos 
	public function create(){
		return view('admin.jogos.cadastro');
	}

	//Cadastra o jogo com os parâmetros da requisição validados
	public function store(CadastroJogoRequest $request){
		if ($request->hasFile('imagemJogo')){
			$imagemJogo = $request->file('imagemJogo');
			$filename = time().'.'.$imagemJogo->getClientOriginalExtension();
			Image::make($imagemJogo)->fit(600, 300)->save(public_path('images/jogos/'.$filename));
		}
		$jogo = Jogo::Create([
				'nomeJogo' => $request->input('nomeJogo'),
				'dataLancamento' => $request->input('dataLancamento'),
				'descricao' => $request->input('descricao'),
				'quantidadeJogadores' => $request->input('quantidadeJogadores'),
				'idDistribuidora' => $request->input('distribuidora'),
				'idDesenvolvedor' => $request->input('desenvolvedor'),
				'imagemJogo'  => isset($filename) ? $filename : 'placeholder.png'
 			]);
		//cadastra as categorias na tabela pivô
		$jogo->categorias()->sync($request->categorias, false);

		return redirect(route('admin.jogos'));
	}

	//Mostra página do jogo especificado no parâmetro da função
	public function show($nomeJogo){
		$jogo = \vapj\Jogo::where('nomeJogo', $nomeJogo)->firstOrFail();
		/*$avaliacaoMedia = DB::table('criticas')->where('idJogo',$jogo->idJogo)->avg('nota');
		$avaliacaoMedia = number_format(floatval($avaliacaoMedia), 1);*/
		$criticaUsuario = \Auth::check() ? \Auth::user()->criticaDoJogo($jogo->idJogo) : null;
		$usuarioPossuiJogo = \Auth::check() ? \Auth::user()->possuiJogo($jogo->idJogo) : false;
		$criticas = $jogo->criticas()->orderBy('created_at', 'desc')->paginate(10);
		JavaScript::put([
			'isLogado' => \Auth::check(), 
			'urlJogou' => route('jogou'),
			'urlCritica' => route('critica'),
			'idJogo'   => $jogo->idJogo,
			'avaliacaousuario' => $criticaUsuario ? $criticaUsuario->nota : null,
			/*'notaMedia' => $jogo->notaMedia,*/
			'usuarioPossuiJogo' => $usuarioPossuiJogo,
		]);
		return view('jogo.jogo', array(
				"jogo" => $jogo,
				"criticas" => $criticas,
				"usuarioPossuiJogo" => $usuarioPossuiJogo,
				"criticaUsuario" => $criticaUsuario
		));
	}

	//Mostra página de edição do jogo
	public function edit($nomeJogo){
		$jogo = Jogo::where('nomeJogo', $nomeJogo)->firstOrFail();
		return view("admin.jogos.editar")->withJogo($jogo);
	}

	//Edita o jogo especificado no parâmetro do método
	public function update(EditarJogoRequest $request, $nomeJogo){
		$jogo = Jogo::where('nomeJogo', $nomeJogo)->firstOrFail();
		$jogo->nomeJogo = $request->nomeJogo;
		$jogo->descricao = $request->descricao;
		$jogo->dataLancamento = $request->dataLancamento;
		$jogo->idDistribuidora = $request->distribuidora;
		$jogo->idDesenvolvedor = $request->desenvolvedor;
		if ($request->hasFile('imagemJogo')){
			$imagemJogo = $request->file('imagemJogo');
			$filename = time().'.'.$imagemJogo->getClientOriginalExtension();
			Image::make($imagemJogo)->fit(600, 300)->save(public_path('images/jogos/'.$filename));
			$imagemAntiga = $jogo->imagemJogo;
			$jogo->imagemJogo = $filename;
			Storage::disk('jogos')->delete($imagemAntiga);
		}
		$jogo->save();
		$jogo->categorias()->sync($request->categorias, false);
		return redirect(route('admin.jogos'));
	}

	//Deleta o jogo especificado no parâmetro do método
	public function destroy($id){
		$jogo = Jogo::find($id);
		Storage::disk('jogos')->delete($jogo->imagemJogo);
		$jogo->delete();
		return response()->json([], 200);
	}

	/**
	 * Método usado para retornar todos os jogos em json
	 * @param  Illuminate\Http\Request $request
	 * @return String json dos jogos
	 */
	public function buscaJogosJson(Request $request){
	    $query = $request->input('q');
	    $jogos = Jogo::where('nomeJogo','LIKE',"%$query%")->get(['idJogo','nomeJogo']);
	    $json = [];
	    foreach ($jogos as $jogo) {
	        $json[] = array('id' => $jogo->idJogo, 'text' => $jogo->nomeJogo);
	    }
	    return response()->json($json);
	}

	/**
	 * Retorna página de jogos do dashboard
	 * @return [type] [description]
	 */
	public function adminIndex(Request $request){
		$jogos = new Jogo;

		$query = $request->has('busca') ? $request->busca : '';
		
		$ordem = $request->has('ordem') ? $request->ordem : 'notaMedia';

		$ascDesc = $ordem == "nomeJogo" ? 'asc' : 'desc';

		$jogos = $jogos->where('nomeJogo', 'LIKE', "%$query%");

		$jogos = $jogos->orderBy($ordem, $ascDesc);

		$jogos = $jogos->paginate(10)->appends([
			'busca' => $request->busca,
			'ordem' => $request->ordem
		]);

		return view('admin.jogos.index')->withJogos($jogos);
	}


}
