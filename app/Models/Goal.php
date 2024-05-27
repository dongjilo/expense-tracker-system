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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($goal) {
            $goal->progress = $goal->calculateProgress();
        });
    }

    public function calculateProgress()
    {
        if ($this->target_amount == 0) {
            return 0;
        }

        return ($this->current_amount / $this->target_amount) * 100;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
