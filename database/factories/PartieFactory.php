<?php

namespace Database\Factories;

use App\Models\Partie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partie>
 */
class PartieFactory extends Factory
{
    protected $model = Partie::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->word,
            'dateDebut' => $this->faker->dateTime,
            'HeureDebut' => $this->faker->time,
            'duree' => $this->faker->numberBetween(1, 120),
            'visibilite' => $this->faker->boolean,
            'joueurAnonyme' => $this->faker->boolean,
            'description' => $this->faker->paragraph,
            'miniature' => $this->faker->imageUrl,
            'imageFond' => $this->faker->imageUrl,
            'couleurFond' => $this->faker->hexColor,
            'niveau' => 1, // Assurez-vous d'avoir une entité de niveau dans la base de données de test
            'admin' => User::factory(), // Crée un utilisateur admin
        ];
    }
}
