<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distinctionjoueurs extends Model
{
    use HasFactory;
    protected $fillable = [
        'distinction',
        'joueur'
];
}
