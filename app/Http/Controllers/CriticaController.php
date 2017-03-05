<?php

namespace vapj\Http\Controllers;

use Illuminate\Http\Request;
use vapj\Critica;
use Auth;
use vapj\Http\Requests\CriticaJogoRequest;
class CriticaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriticaJogoRequest $request)
    {
        $critica = Critica::where('idJogo', $request->idJogo)->where('idUsuario', $request->user()->idUsuario)->first();
        if (!$critica) $critica = new Critica;
        $critica->nota = $request->nota ? (int) $request->nota : null;
        $critica->comentario = $request->comentario;
        $critica->jogo()->associate($request->idJogo);
        $critica->usuario()->associate($request->user()->idUsuario);
        $critica->save();
        $this->calculaNotaMedia($request->idJogo);
        return response()->json(['critica' => $critica], 200);
    }
    /**
     * Calcula novo valor do campo nota média e 
     *  número de críticas para o jogo. 
     * @param  int id do jogo
     * @return \Illuminate\Http\Response
     */
    public function calculaNotaMedia($idJogo){
        $jogo = \vapj\Jogo::find($idJogo);
        $criticas = $jogo->criticas();
        $jogo->notaMedia = $criticas->avg('nota') ? $criticas->avg('nota') : 0.0;
        $jogo->numCriticas = $criticas->count();
        $jogo->save();
    }


    /**
     *  retorna todas as criticas em formato json
     *  @return \Illuminate\Http\Response
     */
    public function criticas(){
        $criticas = Critica::all();
        $response = [
            'criticas' => $criticas
        ];
        return response()->json($response, 201);
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
        $critica = Critica::find($id);
        if (!$critica)
            return response()->json(['message' => 'crítica não encontrada'], 404);
        $critica->comentario = $request->input('comentario');
        $critica->nota = $request->input('nota');
        $critica->save();
        return response()->json(['critica' => $critica], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $critica = Critica::find($id);
        $critica->delete();
        $this->calculaNotaMedia($critica->jogo->idJogo);
        return response()->json([], 200);
    }
}
