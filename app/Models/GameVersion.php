<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        "game_id",
        "path",
    ];

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
