<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\PartieTerminee;
use Carbon\Carbon;

class Partie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'dateDebut',
        'HeureDebut',
        'duree',
        'visibilite',
        'joueurAnonyme',
        'description',
        'miniature',
        'imageFond',
        'couleurFond',
        'niveau',
        'type',
        'admin'
    ];


    protected $dispatchesEvents = [
        'saved' => PartieTerminee::class,
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($partie) {
            if ($partie->isFinished()) {
                event(new PartieTerminee($partie));
            }
        });
    }

    public function isFinished()
    {
        $dateDebut = Carbon::parse($this->dateDebut);
        $dateFin = $dateDebut->addMinutes($this->duree);
        $dateFin->addMinute();
        return Carbon::now()->greaterThan($dateFin);
    }

    // Assurez-vous de définir la relation "joueurs"
    public function joueurs()
    {
        return $this->belongsToMany(User::class, 'resultats', 'partie', 'joueur');
    }
    
    
            
}
