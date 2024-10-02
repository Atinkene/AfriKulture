<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choix extends Model
{
    use HasFactory;
    protected $table = 'choix';
    protected $fillable = [
        'joueur',
        'proposition'
    ];
    public function proposition()
    {
        return $this->belongsTo(Proposition::class, 'proposition');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'joueur');
    }
}
