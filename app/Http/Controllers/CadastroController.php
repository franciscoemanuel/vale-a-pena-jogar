<?php 
namespace vapj\Http\Controllers;
use Illuminate\Support\Facades\DB;	
use Request;
use vapj\Http\Requests\CadastroRequest;
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
		]);
		return redirect('/login');
	}
}

?>