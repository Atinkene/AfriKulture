<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PartieTerminee;
use App\Models\Resultat;

class CalculerClassementJoueurs
{
    public function handle(PartieTerminee $event)
    {
        $partie = $event->partie;

        // Récupérer les joueurs et leurs scores
        $joueurs = $partie->joueurs; // Assurez-vous que la relation "joueurs" est définie dans le modèle Partie

        // Calculer le score de chaque joueur et enregistrer les résultats
        foreach ($joueurs as $joueur) {
            $score = $this->calculerScore($joueur, $partie);
            $rang = $this->calculerRang($score); // Implémentez votre logique de classement ici

            Resultat::create([
                'score' => $score,
                'icone' => $this->determinerIcone($score),
                'rang' => $rang,
                'joueur' => $joueur->id,
                'partie' => $partie->id,
            ]);
        }
    }

    private function calculerScore($joueur, $partie)
    {
        // Implémentez la logique de calcul du score ici
        return rand(0, 100); // Exemple : score aléatoire entre 0 et 100
    }

    private function determinerIcone($score)
    {
        // Implémentez la logique pour déterminer l'icône en fonction du score
        return 'default-icon.png'; // Exemple : icône par défaut
    }

    private function calculerRang($score)
    {
        // Implémentez la logique pour calculer le rang en fonction du score
        return rand(1, 10); // Exemple : rang aléatoire entre 1 et 10
    }
}
