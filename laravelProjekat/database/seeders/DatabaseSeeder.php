<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
            'uloga' => 'admin',
        ]);
        $this->call(FirmaSeeder::class);
        $this->call(ZaposleniSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(FajlSeeder::class);
        $this->call(PrivilegijaSeeder::class);

    }
}
