<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $examenes = Examen::get();
        foreach ($examenes as $examen) {
            $examenpreguntas = Http::withToken(auth()->getToken()->get())->get('http://localhost/examenAPI/public/api/v1/preguntasExamen?idExamen=' . $examen->idExamen)->json();
            $ids_pregunta = implode(',', array_column($examenpreguntas['data'], 'cvePregunta'));
            $preguntas = Http::withToken(auth()->getToken()->get())->get('http://localhost/examenAPI/public/api/v1/preguntas?cvePregunta=' . $ids_pregunta)->json();
            foreach ($preguntas['data'] as $key => $pregunta) {
                $respuestas = Http::withToken(auth()->getToken()->get())->get('http://localhost/exame1nAPI/public/api/v1/respuestas?order=random&cvePregunta=' . $pregunta['cvePregunta'])->json();
                $preguntas['data'][$key]['respuesta'] = $respuestas['data'];
            }
            $examen['pregunta'] = $preguntas['data'];
        }
        return response([
            'data' => $examenes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExamenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'idUsuario' => 'required|numeric|exists:tblusuarios,idUsuario',
                'numPreguntas' => 'required|numeric|max:4'
            ]);
            $examen = Examen::create($validated);
            $preguntas = Http::withToken(auth()->getToken()->get())->get('http://localhost/examenAPI/public/api/v1/preguntas?order=random&limit=4')->json();
            foreach ($preguntas['data'] as $pregunta) {
                $pregunta = Http::withToken(auth()->getToken()->get())->post('http://localhost/examenAPI/public/api/v1/preguntasExamen', [
                    'idExamen' => $examen['idExamen'],
                    'cvePregunta' => $pregunta['cvePregunta']
                ])->json();
            }
            $examen['pregunta'] = $preguntas['data'];
            return response([
                'data' => $examen
            ], 200);
        } catch (Exception $e) {
            Log::alert($e);
            return response([
                'message' => 'Ocurrió un error inesperado'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $examen = Examen::find($id);
        if (!$examen) {
            return response([
                'message' => 'Examen no encontrado'
            ], 404);
        }
        $examenpreguntas = Http::withToken(auth()->getToken()->get())->get('http://localhost/examenAPI/public/api/v1/preguntasExamen?idExamen=' . $examen->idExamen)->json();
        $ids_pregunta = implode(',', array_column($examenpreguntas['data'], 'cvePregunta'));
        $preguntas = Http::withToken(auth()->getToken()->get())->get('http://localhost/examenAPI/public/api/v1/preguntas?cvePregunta=' . $ids_pregunta)->json();
        Log::alert($preguntas['data']);
        foreach ($preguntas['data'] as $key => $pregunta) {
            $respuestas = Http::withToken(auth()->getToken()->get())->get('http://localhost/exame1nAPI/public/api/v1/respuestas?order=random&cvePregunta=' . $pregunta['cvePregunta'])->json();
            Log::alert($respuestas['data']);
            Log::alert($preguntas['data'][$key]);
            $preguntas['data'][$key]['respuesta'] = $respuestas['data'];
        }
        $examen['pregunta'] = $preguntas['data'];
        return response([
            'data' => $examen
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExamenRequest  $request
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'idUsuario' => 'required|numeric|max:11',
            'numPreguntas' => 'required|numeric|max:3'
        ]);
        $examen = Examen::find($id);
        if (!$examen) {
            return response([
                'message' => 'Examen no encontrado'
            ], 404);
        }
        $examen->fill($validated)->save();
        return response([
            'data' => $examen
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Examen  $examen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examen = Examen::find($id);
        if (!$examen) {
            return response([
                'message' => 'Examen no encontrado'
            ], 404);
        }
        $examen->delete();
        return response(null, 204);
    }
}
