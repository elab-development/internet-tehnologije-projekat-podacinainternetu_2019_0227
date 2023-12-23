<?php

namespace Database\Seeders;

use App\Models\Firma;
use Illuminate\Database\Seeder;

class FirmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Firma::factory()->count(5)->create();

        // Firma::create([
        //     'naziv' => 'Firma 1',
        //     'PIB' => '123456789',
        //     'maticniBroj' => '100000001',
        //     'adresa' => 'Adresa 1',
        //     'kontaktTelefon' => '011123456',
        //     'email' => 'kontakt@firma1.com',
        // ]);

        // Firma::create([
        //     'naziv' => 'Firma 2',
        //     'PIB' => '987654321',
        //     'maticniBroj' => '200000002',
        //     'adresa' => 'Adresa 2',
        //     'kontaktTelefon' => '021654321',
        //     'email' => 'kontakt@firma2.com',
        // ]);
    }
}
