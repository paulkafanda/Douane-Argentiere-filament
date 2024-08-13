<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Document;
use App\Models\Dossier;

class DocumentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Document::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'nom_document' => $this->faker->word(),
            'date_document' => $this->faker->dateTime(),
            'date_expiration' => $this->faker->dateTime(),
            'observation' => $this->faker->text(),
            'piece_jointe' => $this->faker->word(),
            'dossier_id' => Dossier::factory(),
        ];
    }
}
