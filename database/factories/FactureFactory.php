<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Facture;

class FactureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facture::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date_fact' => $this->faker->dateTime(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
