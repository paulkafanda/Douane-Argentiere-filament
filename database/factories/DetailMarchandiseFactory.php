<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DetailMarchandise;
use App\Models\Dossier;
use App\Models\Marchandise;

class DetailMarchandiseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailMarchandise::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'qte' => $this->faker->numberBetween(-10000, 10000),
            'marchandise_id' => Marchandise::factory(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
