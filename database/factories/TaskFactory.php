<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->realText(60),
            'user_id'=> $this->faker->numberBetween(1,11),
            'is_checked'=>$this->faker->numberBetween(0,0),
            'created_at'=> now(),
            'updated_at'=> now()
        ];
    }
}
