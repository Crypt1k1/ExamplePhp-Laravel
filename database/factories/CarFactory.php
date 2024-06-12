<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                 'name' => $this->faker->name(),
                  'description' => $this->faker->text( 255),
                   'brand' => $this->faker->word(),
                    'year' => $this->faker->year(),
                    'image' => $this->faker->imageUrl($width = 200, $height = 200),
                     'avarageprice' => $this->faker->randomDigit(),
                    'created_at'=>$this->faker->dateTimeThisDecade("now", 'Europe/Amsterdam'),
                   'updated_at' =>$this->faker->dateTimeThisDecade("now", 'Europe/Amsterdam'),




        ];
    }
}
