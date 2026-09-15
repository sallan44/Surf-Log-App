<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spot extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'region', 'latitude', 'longitude', 'description', 'is_private'];

    protected $casts = ['is_private' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function surfSessions()
    {
        return $this->hasMany(SurfSession::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo_path
            ? Storage::disk('public')->url($this->photo_path) : asset('images/default-spot.jpg');
    }

}