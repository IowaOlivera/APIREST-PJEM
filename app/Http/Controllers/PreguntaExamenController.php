<?php

namespace App\Http\Controllers;

use App\Models\PreguntaExamen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PreguntaExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::alert($request->toArray());
        $examenpreguntas = PreguntaExamen::select('*');
        if ($request->idExamen) {
            $examenpreguntas = $examenpreguntas->where('idExamen', explode(',',$request->idExamen));
        }
        if ($request->cvePregunta) {
            $examenpreguntas = $examenpreguntas->where('cvePregunta', explode(',',$request->cvePregunta));
        }

        return response([
            'data' => $examenpreguntas->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreguntaExamenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::alert(json_encode($request->toArray(), JSON_PRETTY_PRINT));
        $validated = $request->validate([
            'idExamen' => 'required|numeric|exists:tblexamenes,idExamen',
            'cvePregunta' => 'required|numeric|exists:tblpreguntas,cvePregunta'
        ]);
        $preguntaExamen = PreguntaExamen::create(array_merge($validated, ['activo' => 1]));
        return response([
            'data' => $preguntaExamen
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreguntaExamen  $preguntaExamen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreguntaExamen  $preguntaExamen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreguntaExamenRequest  $request
     * @param  \App\Models\PreguntaExamen  $preguntaExamen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreguntaExamen  $preguntaExamen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
