<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->text(100),
            'last_name' => $this->faker->text(100),
            'email' => $this->faker->text(100),
            'phone_no' => $this->faker->text(100),
            'address' => $this->faker->text(100)
        ];
    }
}
