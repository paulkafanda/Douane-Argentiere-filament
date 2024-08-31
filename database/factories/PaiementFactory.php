<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Facture;
use App\Models\Paiement;

class PaiementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paiement::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'num_transaction' => $this->faker->word(),
            'montant' => $this->faker->randomFloat(0, 0, 9999999999.),
            'date_paiement' => $this->faker->dateTime(),
            'preuve_paiement' => $this->faker->word(),
            'facture_id' => Facture::factory(),
        ];
    }
}
