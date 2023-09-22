<?php

namespace Database\Seeders;

use App\Models\Panier;
use Illuminate\Database\Seeder;

class PanierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Panier::factory()->create([
            'id_client' => 2,
            'id_annonce' => 2,
            'jour_reservation' => '12',
        ]);
        Panier::factory()->create([
            'id_client' => 1,
            'id_annonce' => 1,
            'jour_reservation' => '12',
        ]);
    }
}
