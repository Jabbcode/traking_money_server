<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['account_id', 'email', 'password'];

    protected $hidden = ['password', 'account_id', 'remember_token', 'email_verified_at'];

    protected $casts = ['email_verified_at' => 'datetime'];

    public function Account()
    {
        return $this->belongsTo(Account::class);
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function Categories()
    {
        return $this->hasMany(Category::class);
    }
}
