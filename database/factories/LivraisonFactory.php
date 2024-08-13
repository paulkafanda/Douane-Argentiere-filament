<?php

namespace Database\Factories;

use App\Enums\DeliveryState;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Livraison;

class LivraisonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Livraison::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date_livraison' => $this->faker->dateTime(),
            'statut_livraison' => $this->faker->randomElement(DeliveryState::class),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
