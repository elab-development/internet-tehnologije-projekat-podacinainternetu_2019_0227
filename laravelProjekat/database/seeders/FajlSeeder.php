<?php

namespace Database\Seeders;

use App\Models\Fajl;
use Illuminate\Database\Seeder;

class FajlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fajl::factory()->count(10)->create();
    }
}
