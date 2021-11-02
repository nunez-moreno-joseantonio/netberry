<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    //
    public function getAll()
    {
        $response = [];
        try
        {
            $categorias = Categoria::all();
            
        }catch(\Exception $e)
        {
            $response['error'] = $e->getMessage();
            return response(json_encode($response),200)->header('Content-type','text/plain');
        }
            
        return response(json_encode($categorias),200)->header('Content-type','text/plain');
    }
}
