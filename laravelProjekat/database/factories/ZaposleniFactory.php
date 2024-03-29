<?php

namespace Database\Factories;

use App\Models\Firma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class ZaposleniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = User::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' =>'$2y$10$TKh8H1',
            'pozicija' => $this->faker->jobTitle,
            'odeljenje' => $this->faker->word,
            'datum_pocetka_rada' => $this->faker->date(),
            'datum_kraja_ugovora' => $this->faker->date(),
            'plata' => $this->faker->randomFloat(2, 1000, 9000),
            'firma_id' =>random_int(1,Firma::count())

        ];
    }
}
