<?php

namespace Database\Factories;

use App\Models\Fajl;
use App\Models\Firma;
use Illuminate\Database\Eloquent\Factories\Factory;

class FajlFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Fajl::class;
    public function definition()
    {
        return [
            'naziv' => $this->faker->word . '.' . $this->faker->fileExtension,
            'opis' => $this->faker->sentence,
            'putanja' => $this->faker->url,
            'firma_id' => random_int(1,Firma::count()),
        ];
    }
}
