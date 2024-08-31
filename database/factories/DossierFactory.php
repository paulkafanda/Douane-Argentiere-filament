<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Dossier;

class DossierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dossier::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nom_dossier' => $this->faker->word(),
            'client_id' => Client::factory(),
        ];
    }
}
