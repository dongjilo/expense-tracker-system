<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'target_amount', 'target_date', 'current_amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
