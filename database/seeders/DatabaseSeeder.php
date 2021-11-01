<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $categoria = new Categoria();
        $categoria->nombre = "PHP";
        $categoria->save();
        $categoria = new Categoria();
        $categoria->nombre = "Javascript";
        $categoria->save();
        $categoria = new Categoria();
        $categoria->nombre = "CSS";
        $categoria->save();
    }
}
