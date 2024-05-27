<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function userExpensesTotal()
    {
        return $this->hasOne(UserExpensesTotal::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

}
