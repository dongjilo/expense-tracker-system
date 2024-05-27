<?php

namespace App\Models;

use Hamcrest\Core\Set;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }
}
