<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactNumber>
 */
class ContactNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'contact_number' => $this->faker->phoneNumber(),
            'employee_id' => $this->faker->randomElement(Employee::all()->pluck('id')->toArray())
        ];
    }
}
