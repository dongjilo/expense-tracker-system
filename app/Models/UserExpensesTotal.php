<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExpensesTotal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'total_expenses',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
