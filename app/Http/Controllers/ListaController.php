<?php

namespace vapj\Http\Controllers;

use Illuminate\Http\Request;
use vapj\Http\Requests\CadastroListaRequest;
use vapj\Http\Requests\ComentarioListaRequest;
use vapj\Lista;
use JavaScript;
class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $listas = new Lista;

        $query = $request->has('busca') ? $request->busca : '';

        $ordem = $request->has('ordem') ? $request->ordem : 'qtdCurtidas';

        $ascDesc = $ordem == "nomeLista" ? 'asc' : 'desc';

        $listas = $listas->where('nomeLista', 'LIKE', "%$query%");

        $listas = $listas->orderBy($ordem, $ascDesc);

        $listas = $listas->paginate(10)->appends([
            'busca' => $request->busca,
            'ordem' => $request->ordem
        ]);

        return view("lista.index")->withListas($listas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lista.novaLista');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CadastroListaRequest $request)
    {
        $lista = new Lista();
        $lista->nomeLista = $request->nomeLista;
        $lista->descricaoLista = $request->descricaoLista;
        $lista->usuario()->associate($request->user()->idUsuario);
        $lista->qtdJogos = sizeof($request->jogos);
        $lista->save();
        $lista->jogos()->sync($request->jogos, false);
        $id = $lista->idLista;
        return redirect("/listas/$id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lista = \vapj\lista::where('idLista', $id)->firstOrFail();
        $usuarioCurtiuLista =  \Auth::check() ? \Auth::user()->curtiuLista($id) : false;
        $comentarioUsuario = \Auth::check() ? \Auth::user()->comentarios()->where('idLista', $id)->first() : null;
        JavaScript::put([
           'isLogado' => \Auth::check(), 
           'urlCurtir' => route('curtirLista'),
           'urlExcluirLista' => route('excluirLista', $id),
           'urlComentario' => route('comentarLista'),
        ]);
        return view('lista.single',
        [
            "lista" => $lista,
            "jogos" => $lista->jogos()->paginate(10, ['*'], 'pg_jogos'),
            "usuarioCurtiuLista" => $usuarioCurtiuLista,
            "comentarioUsuario" => $comentarioUsuario
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lista = \vapj\lista::where('idLista', $id)->firstOrFail();
        return view("lista.editar")->withLista($lista);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $lista = \vapj\lista::where('idLista', $id)->firstOrFail();
       $lista->nomeLista = $request->nomeLista;
       $lista->descricaoLista = $request->descricaoLista;
       $lista->jogos()->sync($request->jogos, false);
       $lista->qtdJogos = sizeof($request->jogos);
       $lista->save();
       $id = $lista->idLista;
       return redirect("/listas/$id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lista = Lista::find($id);
        $lista->delete();
        return response()->json([], 200);
    }

    /**
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function curtirLista(Request $request){
        $idLista = $request->idLista;
        $idUsuario = $request->user()->idUsuario;
        $lista = Lista::find($idLista);
        $curtida = $lista->curtidas()->where('idUsuario', $idUsuario)->first();
        if (!$curtida) {
            $curtida = new \vapj\Curtida;
            $curtida->curtida = true;
            $curtida->usuario()->associate($idUsuario);
            $curtida->lista()->associate($idLista);
            $curtida->save();
        }
        else 
            $curtida->delete();
        $lista->qtdCurtidas = $lista->curtidas()->count();
        $lista->save();
       return response()->json([""], 200);
    }

    /**
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function comentarLista(ComentarioListaRequest $request){
       $comentario = \vapj\Comentario::where('idLista', $request->idLista)->where('idUsuario', $request->user()->idUsuario)->first();
       if (!$comentario) $comentario = new \vapj\Comentario;
       $comentario->comentario = $request->comentario;
       $comentario->usuario()->associate($request->user()->idUsuario);
       $comentario->lista()->associate($request->idLista);
       $comentario->save();
       $lista = $comentario->lista;
       $lista->qtdComentarios = $lista->comentarios()->count();
       $lista->save();
       return response()->json([""], 200);
    }

    public function adminIndex(Request $request){
        $listas = new Lista;

        $query = $request->has('busca') ? $request->busca : '';
        
        $listas = $listas->where('nomeLista', 'LIKE', "%$query%");

        // $listas = $listas->orderBy($ordem, $ascDesc);

        $listas = $listas->paginate(10)->appends([
            'busca' => $request->busca,
            // 'ordem' => $request->ordem
        ]);
        return view('admin.listas.index')->withListas($listas);
    }
}
