<?php

namespace App\Http\Controllers;

use App\Events\HistoriaAsistida;
use App\Http\Controllers\Controller;
use App\Models\HistoriaMedica;
use Illuminate\Http\Request;



class HistoriaMedicaController extends Controller
{
    /**
     * Marcar una historia médica como asistida.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function marcarAsistida(Request $request, $id)
    {
        try {
            // Encontrar la historia médica por ID
            $historia = HistoriaMedica::findOrFail($id);

            // Verificar si la historia ya está marcada como asistida
            if ($historia->asistida) {
                return response()->json(['message' => 'La historia médica ya está marcada como asistida.']);
            }

            // Actualizar la historia médica como asistida (puedes ajustar esto según tu modelo)
            $historia->update(['asistida' => true]);

            // Evento: HistoriaAsistida
            event(new HistoriaAsistida(auth()->user(), $historia));

            return response()->json(['message' => 'Historia médica marcada como asistida.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al marcar la historia médica como asistida.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Obtener todas las historias médicas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $historias = HistoriaMedica::all();
        return response()->json(['historias' => $historias]);
    }

    /**
     * Obtener una historia médica específica por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $historia = HistoriaMedica::findOrFail($id);
            return response()->json(['historia' => $historia]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Historia médica no encontrada.', 'error' => $e->getMessage()], 404);
        }
    }

    /**
     * Crear una nueva historia médica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    try {

        // Validar los datos del formulario según tus necesidades
        $request->validate([
            'profesional_id' => 'required|numeric',
            'paciente_id' => 'required|numeric',
            'hora_fecha' => 'required|date',
            'consecutivo' => 'required|string',
            'estado_paciente' => 'required|string',
            'antecedentes' => 'required|string',
            'evolucion_final' => 'required|string',
            'concepto_profesional' => 'required|string',
            'recomendaciones' => 'required|string',
        ]);

        // Crear una nueva historia médica
        $historia = HistoriaMedica::create([
            'profesional_id' => $request->profesional_id,
            'paciente_id' => $request->paciente_id,
            'hora_fecha' => $request->hora_fecha,
            'consecutivo' => $request->consecutivo,
            'estado_paciente' => $request->estado_paciente,
            'antecedentes' => $request->antecedentes,
            'evolucion_final' => $request->evolucion_final,
            'concepto_profesional' => $request->concepto_profesional,
            'recomendaciones' => $request->recomendaciones,
            'asistida' => false, // Por defecto, la historia médica no está asistida
        ]);

        return response()->json(['message' => 'Historia médica creada exitosamente.', 'historia' => $historia], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al crear la historia médica.', 'error' => $e->getMessage()], 500);
    }
}


    /**
     * Actualizar una historia médica existente.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            // Validar los datos del formulario según tus necesidades
            $request->validate([
                'profesional_id' => 'required|numeric',
                'paciente_id' => 'required|numeric',
                'hora_fecha' => 'required|date',
                'consecutivo' => 'required|string',
                'estado_paciente' => 'required|string',
                'antecedentes' => 'required|string',
                'evolucion_final' => 'required|string',
                'concepto_profesional' => 'required|string',
                'recomendaciones' => 'required|string',
                'asistida' => 'required|boolean', // Asegúrate de ajustar la validación según tu modelo
            ]);

            // Encontrar la historia médica por ID
            $historia = HistoriaMedica::findOrFail($id);

            // Actualizar la historia médica
            $historia->update([
                'profesional_id' => $request->profesional_id,
                'paciente_id' => $request->paciente_id,
                'hora_fecha' => $request->hora_fecha,
                'consecutivo' => $request->consecutivo,
                'estado_paciente' => $request->estado_paciente,
                'antecedentes' => $request->antecedentes,
                'evolucion_final' => $request->evolucion_final,
                'concepto_profesional' => $request->concepto_profesional,
                'recomendaciones' => $request->recomendaciones,
                'asistida' => $request->asistida,
            ]);

            // Evento: HistoriaAsistida
            if ($request->asistida) {
                event(new HistoriaAsistida(auth()->user(), $historia));
            }

            return response()->json(['message' => 'Historia médica actualizada correctamente.', 'historia' => $historia]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la historia médica.', 'error' => $e->getMessage()], 500);
        }
    }


    /**
     * Eliminar una historia médica específica por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $historia = HistoriaMedica::findOrFail($id);
            $historia->delete();
            return response()->json(['message' => 'Historia médica eliminada exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la historia médica.', 'error' => $e->getMessage()], 500);
        }
    }
}
