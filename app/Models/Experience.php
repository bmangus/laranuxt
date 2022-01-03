<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'company', 'title', 'start_date', 'end_date', 'description', 'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
