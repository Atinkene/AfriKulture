<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    use HasFactory;
    protected $table = 'niveaus';

    protected $fillable = [
        'nom',
        'force',
        'icone'
];
}
