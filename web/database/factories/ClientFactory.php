<?php

namespace Database\Factories;

use App\Helpers\CPFHelper;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cpf' => CPFHelper::generate(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail,
            'gender' => $this->faker->randomElement(['Masculino', 'Feminino', 'Outro']),
        ];
    }
}
