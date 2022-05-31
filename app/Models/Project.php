<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = 
    ['title', 'description', 'user_id', 'team_id', 'overview'];

    public function team() {
        return $this->belongsTo(Team::class);
    }

    public function boards() {
        return $this->hasMany(Board::class);
    }
}
