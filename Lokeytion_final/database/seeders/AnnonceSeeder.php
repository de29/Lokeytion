<?php

namespace Database\Seeders;

use App\Models\Annonce;
use Illuminate\Database\Seeder;

class AnnonceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Annonce::factory()->create([
            'id_objet' => 2,
            'id_user' => 1,
            'Titre' => 'beautiful pan',
            'ville' => 'Rabat',
            'prix' => 33,
            'status' => 'disponible',
        ]);

        Annonce::factory()->create([
            'id_objet' => 3,
            'id_user' => 2,
            'Titre' => 'Cocotte',
            'ville' => 'Agadir',
            'prix' => 43,
            'status' => 'disponible',
        ]);

        Annonce::factory()->create([
            'id_objet' => 1,
            'id_user' => 2,
            'Titre' => 'Chkara',
            'ville' => 'Tanger',
            'prix' => 43,
            'status' => 'disponible',
        ]);
    }
}
