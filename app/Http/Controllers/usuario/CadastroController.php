<?php 
namespace vapj\Http\Controllers\usuario;
use Illuminate\Support\Facades\DB;	
use Request;
use vapj\Http\Requests\usuario\CadastroRequest;
use vapj\Http\Controllers\Controller;
use vapj\User;
class CadastroController extends Controller{
	
	public function form(){
		return view("usuario.cadastro");
	}

	public function cadastro(CadastroRequest $request){
		$usuario =	User::Create([
				'nomeUsuario' => $request->input('nomeUsuario'),
				'emailUsuario' => $request->input('emailUsuario'),
				'senhaUsuario' => bcrypt($request->input('senhaUsuario')),
				'nomeCompletoUsuario' => $request->input('nomeCompletoUsuario'),
				'sexo' => $request->input('sexo'),
				'dataNascimentoUsuario' => $request->input('dataNascimentoUsuario')
			]);
		return redirect('/login');
	}
}

?>