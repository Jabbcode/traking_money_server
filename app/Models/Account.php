<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['available', 'user_id'];

    public function User()
    {
        return $this->hasOne(User::class);
    }

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
