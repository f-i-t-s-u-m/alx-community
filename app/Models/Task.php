<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'board_id', 'user_id'];    
    
    public function board() {
        return $this->belongsTo(Board::class);
    }
}
