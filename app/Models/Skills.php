<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'years_experience', 'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
