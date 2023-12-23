<?php

namespace Database\Seeders;

use App\Models\Zaposleni;
use Illuminate\Database\Seeder;

class ZaposleniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zaposleni::factory()->count(10)->create();


    }
}
