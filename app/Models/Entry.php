<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Entry extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($entry) {
            $entry->user_id = Auth::id();
        });
    }

    public function scopeOwnEntries($query)
    {
        if (Auth::user()->role->name == "admin") {
            return $query;
        }

        return $query->where('user_id', Auth::user()->id);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserBrowseAttribute()
    {
        return "sss";
    }
}
