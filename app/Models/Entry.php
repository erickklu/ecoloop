<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Entry extends Model
{
    use HasFactory; 
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

    public function requestedEntries()
    {
        return $this->hasMany(RequestedEntry::class);
    }

    function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getUserBrowseAttribute()
    {
        return "sss";
    }

    public function getFormattedDateAttribute()
    {
        $updatedAt = Carbon::parse($this->updated_at);
        $now = Carbon::now();
        $diffInDays = $updatedAt->diffInDays($now);

        if ($diffInDays > 7) {
            return $updatedAt->locale('es')->isoFormat('[Actualizado el] D [de] MMMM [de] YYYY');
        } else {
            return $updatedAt->locale('es')->diffForHumans();
        }
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
