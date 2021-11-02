<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tarea extends Model
{
    use HasFactory;

    protected $primaryKey = 'tarea_id';

    public function Categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

}
