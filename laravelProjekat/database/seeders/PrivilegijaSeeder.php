<?php

namespace Database\Seeders;

use App\Models\Privilegija;
use Illuminate\Database\Seeder;

class PrivilegijaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Privilegija::factory()->count(5)->create();
    }
}
