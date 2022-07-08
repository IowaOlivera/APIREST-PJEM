<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $preguntas = Pregunta::select('*');
        if ($request->order == 'random') {
            $preguntas->inRandomOrder();
        }
        if ($request->limit) {
            $preguntas->limit($request->limit);
        }
        if ($request->cvePregunta) {
            $preguntas->whereIn('cvePregunta', explode(',',$request->cvePregunta));
        }
        return response([
            'data' => $preguntas->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'desPregunta' => 'required|string|max:500',
            'activo' => 'required|string|max:1'
        ]);
        $pregunta = Pregunta::create($validated);
        return response([
            'data' => $pregunta
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pregunta = Pregunta::find($id);
        if (!$pregunta) {
            return response([
                'message' => 'Pregunta no encontrada'
            ], 404);
        }
        return response([
            'data' => $pregunta
        ], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'desPregunta' => 'required|string|max:500',
            'activo' => 'required|string|max:1'
        ]);
        $pregunta = Pregunta::find($id);
        if (!$pregunta) {
            return response([
                'message' => 'Pregunta no encontrada'
            ], 404);
        }
        $pregunta->fill($validated)->save();
        return response([
            'data' => $pregunta
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pregunta  $pregunta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pregunta = Pregunta::find($id);
        if (!$pregunta) {
            return response([
                'message' => 'Pregunta no encontrada'
            ], 404);
        }
        $pregunta->delete();
        return response([
            'data' => $pregunta
        ], 200);
    }
}
