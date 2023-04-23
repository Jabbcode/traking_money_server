<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_transaction extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public $timestamps = false;

    public function Transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
