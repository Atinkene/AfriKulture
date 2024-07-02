<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'admin'
    ];
            
}
