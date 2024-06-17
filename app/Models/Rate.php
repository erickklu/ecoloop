<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'stars',
        'user_id',
        'qualifier'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualifier()
    {
        return $this->belongsTo(User::class, 'qualifier');
    }

}
