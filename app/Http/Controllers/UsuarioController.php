<?php 
namespace vapj\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	
use vapj\Http\Requests\CadastroUsuarioRequest;
use vapj\Http\Requests\EditarUsuarioRequest;
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
            $usuario->jogos()->attach([$idJogo]);
        //$usuario->jogos()->attach([$request->idJogo => ['avaliacao'=>$request->avaliacao] ]);
        return response()->json([
            "jogo" => $idJogo,
            "usuarioPossuiJogo" => $usuarioPossuiJogo != "true",
        ]);
    }

    // View do perfil do usuário
    public function show($usuario){
        $usuario = User::where("nomeUsuario", $usuario)->firstOrFail();
        return view('usuario.perfil', [
            "usuario" => $usuario,
            "jogos"   => $usuario->jogos()->paginate(10, ['*'], 'pg_jogos'),
            "criticas" => $usuario->criticas()->orderBy('created_at', 'desc')->paginate(10, ['*'], 'pg_criticas'),
            "listas"   => $usuario->listas()->paginate(10, ['*'], 'pg_listas')
        ]);
    }

    public function destroy($id){
        $usuario = User::find($id);
        $usuario->delete();
        return response()->json([], 200);
    }

    public function adminIndex(Request $request){
        $usuarios = new User;

        $query = $request->has('busca') ? $request->busca : '';
        
        $usuarios = $usuarios->where('nomeUsuario', 'LIKE', "%$query%");

        // $usuarios = $usuarios->orderBy($ordem, $ascDesc);

        $usuarios = $usuarios->paginate(10)->appends([
            'busca' => $request->busca,
            // 'ordem' => $request->ordem
        ]);
        return view('admin.usuarios.index')->withUsuarios($usuarios);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($usuario)
    {
        $usuario = User::where('nomeUsuario', $usuario)->firstOrFail();
        return view('admin.usuarios.editar')->withUsuario($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditarUsuarioRequest $request, $usuario)
    {
        $usuario = User::where('nomeUsuario', $usuario)->firstOrFail();
        $usuario->nomeCompletoUsuario = $request->nomeCompletoUsuario;
        $usuario->sexo = $request->sexo;
        $usuario->nomeUsuario = $request->nomeUsuario;
        $usuario->emailUsuario = $request->emailUsuario;
        $usuario->dataNascimentoUsuario = $request->dataNascimentoUsuario;
        $usuario->save();
        return redirect(route('admin.usuarios'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = new User;

        $query = $request->has('busca') ? $request->busca : '';

        $usuarios = $usuarios->where('nomeUsuario', 'LIKE', "%$query%");

        $usuarios = $usuarios->paginate(10)->appends([
            'busca' => $request->busca,
            'ordem' => $request->ordem
        ]);

        return view('usuario.index')->withUsuarios($usuarios);
    }

    /**
     * Mostra o form para editar dados do usuário
     * @return \Illuminate\Http\Response
     */
    public function dadosUsuario(Request $request){
        $usuario = $request->user();
        return view('usuario.dados')->withUsuario($usuario);
    }

    /**
     * Mostra o form para editar dados do usuário
     * @return \Illuminate\Http\Response
     */
    public function postDadosUsuario(EditarUsuarioRequest $request){
        $usuario = $request->user();
        $usuario->nomeCompletoUsuario = $request->nomeCompletoUsuario;
        $usuario->sexo = $request->sexo;
        $usuario->emailUsuario = $request->emailUsuario;
        $usuario->dataNascimentoUsuario = $request->dataNascimentoUsuario;
        $usuario->save();
        \Session::flash('sucesso', 'Dados alterados com sucesso!');
        return redirect(route('usuario.dados'));
    }
}

?>