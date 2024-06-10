<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "optional_thumbnail",
        "slug",
        "author_id",
    ];

    protected $appends = ["score_count"];

    public function game_versions()
    {
        return $this->hasMany(GameVersion::class);
    }
    public function scores()
    {
        return $this->hasManyThrough(Score::class, GameVersion::class);
    }

    public function getScoreCountAttribute()
    {
        return $this->scores()->sum("score");
    }
}
