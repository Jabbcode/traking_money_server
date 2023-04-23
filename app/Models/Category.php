<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $table = 'categories';

    protected $fillable = ['category'];

    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    public function Transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
