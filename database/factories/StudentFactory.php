<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->numberBetween($min = 0, $max = 1),
            'dateBirth' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->numerify('##########'),
            'address' => $this->faker->address(),
            'fee' => '2800000',
            'idClass' => 5,
            'idStudentShip' => 1,
            'disable' => 0,

        ];
    }
}
