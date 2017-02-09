<?php 
namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	
use vapj\Http\Requests\CadastroUsuarioRequest;
use vapj\User;
use vapj\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Lang;
class UsuarioController extends Controller{

    //Classe que autentica usuário na aplicação.
    use AuthenticatesUsers;

     //Página de redirecionamento após sucesso da autenticação.
    protected $redirectTo = '/'; 

    //Contrutor da classe, que ao ser instanciada especifica o middleware guest
    public function __construct()
    {   
        //Middleware que redireciona para a home caso o usuário esteja logado
        /*$this->middleware('guest', ['except' => ['logout', 'jogou', 'critica']]);*/
        $this->middleware('autorizador');
    }

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

      /**
     * Subistitui método de retorno quando ocorre falha na autenticação.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'error' => Lang::get('auth.failed')
            ], 401);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }

    //Adiciona jogos confirmados como jogados a tabela pivô
    public function jogou(Request $request){
        $usuario = Auth::user();
        $usuarioPossuiJogo = $request->usuarioPossuiJogo;
        $idJogo = $request->idJogo;
        if ($usuario == null)
            return response('Falha na autenticação', 401);
        if ($usuarioPossuiJogo == "true")
            $usuario->jogos()->detach($idJogo);
        else
            $usuario->jogos()->sync([$idJogo]);
        //$usuario->jogos()->attach([$request->idJogo => ['avaliacao'=>$request->avaliacao] ]);
        return response()->json([
            "jogo" => $idJogo,
            "usuarioPossuiJogo" => $usuarioPossuiJogo != "true",
        ]);
    }

    // View do perfil do usuário
    public function show($usuario){
        $usuario = User::where("nomeUsuario", $usuario)->firstOrFail();
        $criticas = $usuario->criticas()->orderBy('created_at', 'desc')->paginate(10);
        return view('usuario.perfil')->withUsuario($usuario)->withCriticas($criticas);
    }
}

?>