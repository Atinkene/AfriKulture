<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculerClassementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $partieId;

    public function __construct($partieId)
    {
        $this->partieId = $partieId;
    }

    public function handle()
    {
        // Récupérer la partie
        $partie = Partie::find($this->partieId);

        // Vérifier si la partie existe toujours et si elle est terminée
        if ($partie && $partie->estTerminee()) {
            // Calculer le classement
            $partie->calculerClassement();
        }
    }
}
