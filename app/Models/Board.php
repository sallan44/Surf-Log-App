<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'length_ft'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function surfSessions()
    {
        return $this->hasMany(SurfSession::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo_path
            ? Storage::disk('public')->url($this->photo_path)
            : asset('images/default-board.jpg');
    }

}