<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $primaryKey = 'categoria_id';

    public function Cursos()
    {
        return $this->belongsToMany(Curso::class);
    }
    
}
