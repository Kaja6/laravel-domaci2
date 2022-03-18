<?php

namespace Database\Factories;

use App\Models\Designer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dress>
 */
class DressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'model'=>$this->faker->word(),
            'color'=>$this->faker->word(),
            'releaseYear'=>$this->faker->numberBetween(1950,2022),
            'designer_id'=>Designer::factory(),
            'type_id'=>$this->faker->numberBetween(1,4),
            'user_id'=>User::factory()
        ];
    }
}
