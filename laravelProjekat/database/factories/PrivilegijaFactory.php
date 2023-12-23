<?php

namespace Database\Factories;

use App\Models\Fajl;
use App\Models\Privilegija;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrivilegijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Privilegija::class;
    public function definition()
    {
        $permissions = ['read', 'write', 'delete'];
        return [
            'permission' => $this->faker->randomElement($permissions),
            'zaposleni_id' =>random_int(1,User::count()),  
            'fajl_id' => random_int(1,Fajl::count())
        ];
    }
}
