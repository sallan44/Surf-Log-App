<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SurfSession extends Model
{
    use HasFactory;

    protected $fillable = ['spot_id', 'board_id', 'session_date', 'rating', 'wave_count', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spot()
    {
        return $this->belongsTo(Spot::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}