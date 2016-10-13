<?php
namespace vapj\Http\Controllers;

use Illuminate\Http\Request;
use vapj\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    //Classe que autentica usuário na aplicação.
    use AuthenticatesUsers;
    
    //Método que retorna view de login
    public function form(){
    	return view("usuario.login");
    }

    //Método que autentica usuário na aplicação, utilizando métodos da classe AuthenticatesUsers.
    public function login(Request $request){
    	$credenciais = [
            "emailUsuario" => $request->input('emailUsuario'),
            "password" => $request->input('senhaUsuario'),   
        ];
    	if($this->guard()->attempt($credenciais, $request->has('remember'))){
    		return $this->sendLoginResponse($request);
    	}else
	        return $this->sendFailedLoginResponse($request);
    }

    //Página de redirecionamento após sucesso da autenticação.
    protected $redirectTo = '/'; 

    //Contrutor da classe, que ao ser instanciada especifica o middleware guest
    public function __construct()
    {   
        //Middleware que redireciona para a home caso o usuário esteja logado
        $this->middleware('guest', ['except' => 'logout']);
    }
}
