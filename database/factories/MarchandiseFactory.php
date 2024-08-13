<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Dossier;
use App\Models\Marchandise;

class MarchandiseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Marchandise::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'designation' => $this->faker->word(),
            'type_marchandise' => $this->faker->word(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
