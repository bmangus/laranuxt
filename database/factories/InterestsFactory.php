<?php

namespace Database\Factories;

use App\Models\Interests;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterestsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interests::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->text(50),
            'user_id' => 1,
        ];
    }
}
