<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{
    use HasFactory;

    protected $fillable = [
      'description', 'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
