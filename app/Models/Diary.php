<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Diary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'title',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
