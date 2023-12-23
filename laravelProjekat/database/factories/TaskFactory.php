<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Task::class;
  
    public function definition()
    {
        $statusOptions = ['zavrseno', 'otkazano', 'u izradi'];
        return [
            'zaposleni_id' =>random_int(1,User::count()),  
            'naziv' => $this->faker->sentence,
            'opis' => $this->faker->paragraph,
            'rok' => $this->faker->date(),
            'status' => $this->faker->randomElement($statusOptions)
        ];
    }
}
