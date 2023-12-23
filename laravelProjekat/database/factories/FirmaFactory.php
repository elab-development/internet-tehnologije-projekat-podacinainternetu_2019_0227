<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FirmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'naziv' => $this->faker->company,
            'PIB' => $this->faker->unique()->numerify('#########'),
            'maticniBroj' => $this->faker->unique()->numerify('#########'),
            'adresa' => $this->faker->address,
            'kontaktTelefon' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->companyEmail,
        ];
    }
}
