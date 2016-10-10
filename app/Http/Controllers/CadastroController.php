<?php 
namespace vapj\Http\Controllers;
use Illuminate\Support\Facades\DB;	
use Request;
use vapj\User;
class CadastroController extends Controller{
	public function form(){
		return view("usuario.cadastro");
	}

	public function cadastro(){
		User::Create([
			'nomeUsuario' => Request::input('nomeUsuario'),
			'emailUsuario' => Request::input('emailUsuario'),
			'senhaUsuario' => bcrypt(Request::input('senhaUsuario')),
		]);
		return redirect('/login');
	}
}

?>