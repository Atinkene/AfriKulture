<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'duree',
        'visibilite',
        'niveau',
        'dateDebut',
        'HeureDebut',
        'admin'
    ];
            
}
