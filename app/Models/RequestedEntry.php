<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RequestedEntry extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'entry_id', 'request_date'];

    protected $guarded = [];

    function scopeOwnRequestedEntries(Builder $query)
    {
        if (Auth::user()->role->name == "admin") {
            return $query;
        }

        $ids = Auth::user()->entries->pluck("id");
        return $query->whereIn('entry_id',$ids);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
