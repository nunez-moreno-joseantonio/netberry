<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TareaController extends Controller
{
    //
    protected $request;

    public function getAll()
    {
        
        try
        {
            $tareas = Tarea::all();
            
            foreach ($tareas as $tarea)
            {
                $t['id'] = $tarea->tarea_id;
                $t['nombre'] = $tarea->nombre;
                $t['categorias'] = $this->getCategorias($tarea->tarea_id);
                
                $response[] = $t; 
            }
        }catch(\Exception $e){
            $response['error'] = $e->getMessage();
            return response(json_encode($response),200)->header('Content-type','text/plain');
        }
        
        return response(json_encode($response),200)->header('Content-type','text/plain');
    }

    public function create(Request $request)
    {
        try
        {
            $tarea = new Tarea();

            $tarea->nombre = $request->input('nombre');
            $tarea->save();
            $categorias = $request->input('categorias');
            $categorias = explode('|',$categorias);
            foreach($categorias as $categoria)
            {
                DB::table('categoria_tarea')->insert([
                    ['categoria_id' => $categoria, 'tarea_id' => $tarea->tarea_id]
                ]);
            
            }

            return response(json_encode(['mensaje'=> "Tarea creada correctamente."]),200)->header('Content-type','text/plain');
        }
        catch(\Exception $e){
            $error = "Error al crear la tarea: ".$e->getMessage();
            return response(json_encode(['error'=> $error]),200)->header('Content-type','text/plain');
        }
    }

    public function delete(Request $request)
    {
        try
        {
            $tarea = Tarea::find($request->input('id'));

            $tarea->delete();

            return response(json_encode(['mensaje'=> "Tarea borrada correctamente."]),200)->header('Content-type','text/plain');
        }
        catch(\Exception $e)
        {
            $error = "Error al borrar la tarea: ".$e->getMessage();
            return response(json_encode(['error'=> $error]),200)->header('Content-type','text/plain');
        }
    }

    public function getCategorias($tarea_id)
    {
        $query = "SELECT c.nombre 
                FROM categorias c
                INNER JOIN categoria_tarea ct ON c.categoria_id = ct.categoria_id
                WHERE ct.tarea_id = $tarea_id";
        return DB::select($query);
    }
}
