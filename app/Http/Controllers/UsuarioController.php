<?php 
namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	
use vapj\Http\Requests\CadastroUsuarioRequest;
use vapj\User;
use vapj\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class UsuarioController extends Controller{

    //Classe que autentica usuário na aplicação.
    use AuthenticatesUsers;

    //Mostra a view de cadastro de usuários
    public function create(){
        return view("usuario.cadastro");
    }

    //Cadastra o jogo com os parâmetros da requisição validados
    public function store(CadastroUsuarioRequest $request){
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

    //Método que retorna view de login
    public function formLogin(){
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
        }
        return $this->sendFailedLoginResponse($request);
    }

    //Adiciona jogos confirmados como jogados a tabela pivô
    public function joguei(Request $request){
        $usuario = Auth::user(); 
        if ($request->jaJogou == "true"){
            $usuario->jogos()->detach($request->idJogo);
            return response()->json(['msg' => 'Jogo deletado da biblioteca com sucesso!']);
        }
        $usuario->jogos()->attach([$request->idJogo]);
        return response()->json(['msg' => 'Jogo adicionado biblioteca com sucesso!']);
    }

    //Página de redirecionamento após sucesso da autenticação.
    protected $redirectTo = '/'; 

    //Contrutor da classe, que ao ser instanciada especifica o middleware guest
    public function __construct()
    {   
        //Middleware que redireciona para a home caso o usuário esteja logado
        $this->middleware('guest', ['except' => ['logout', 'joguei']]);
    }
}

?>