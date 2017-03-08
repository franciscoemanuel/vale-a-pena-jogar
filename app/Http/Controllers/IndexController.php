<?php  
namespace vapj\Http\Controllers;

use Illuminate\Http\Request;
use JavaScript;
use vapj\Jogo;
use vapj\Lista;
class IndexController extends Controller
{

    /**
     * Mostra a view index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$jogosMelhorAvaliados = Jogo::all()->sortByDesc('notaMedia')->take(4);
    	$jogosLancadosRecentemente = Jogo::where('dataLancamento', '>=', \Carbon\Carbon::now()->subMonth()->format('Y-m-d'))
        ->where('dataLancamento', '<=', \Carbon\Carbon::now()->format('Y-m-d'))->get()->take(4);
    	$jogosEmBreve = Jogo::where('dataLancamento', '>', \Carbon\Carbon::now()->format('Y-m-d'))->get()->take(4);
    	$listasMelhorAvaliadas = Lista::all()->sortByDesc('qtdCurtidas')->take(4);
    	$listasMaisComentadas = Lista::all()->sortByDesc('qtdComentarios')->take(4);
        return view('home', [
        	"jogosMelhorAvaliados" => $jogosMelhorAvaliados,
        	"jogosLancadosRecentemente" => $jogosLancadosRecentemente,
        	"jogosEmBreve" => $jogosEmBreve,
        	"listasMelhorAvaliadas" => $listasMelhorAvaliadas,
        	"listasMaisComentadas" => $listasMaisComentadas,
        ]);        
    }
}
