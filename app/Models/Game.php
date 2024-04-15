<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['moves_counter', 'result', 'first_move'];

    protected $casts = [
        'moves_counter' => 'integer',
        'result' => 'integer',
        'first_move' => 'boolean', 
    ];
}
