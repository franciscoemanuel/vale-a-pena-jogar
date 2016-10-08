<?php 
namespace vapj\Http\Controllers;
use Illuminate\Support\Facades\DB;	
use Request;
use vapj\Usuario;
class UsuarioController extends Controller{
	public function cadastro(){
		return view("usuario.cadastro");
	}

	public function cadastrar(){
		Usuario::Create(Request::all());
		return redirect('/');
	}
}

?>