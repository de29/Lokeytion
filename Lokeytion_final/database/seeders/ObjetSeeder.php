<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\objet;

class ObjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Objet::factory()->create([
            'id_user' => 1,
            'nom' => 'beautiful pan',
            'categorie' => 'Cuisine',
            'discription' => 'It is a beautiful pan',
            'image1' => 'mn b3d'
        ]);

        Objet::factory()->create([
            'id_user' => 2,
            'nom' => 'Cocotte',
            'categorie' => 'Cuisine',
            'discription' => 'It is a beautiful cocotte',
            'image1' => 'mn b3d'
        ]);

        Objet::factory()->create([
            'id_user' => 2,
            'nom' => 'chkara',
            'categorie' => 'Ecole',
            'discription' => 'It is a beautiful chkara',
            'image1' => 'mn b3d'
        ]);
    }
}
