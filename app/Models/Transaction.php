<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'account_id', 'user_id', 'type_transaction_id'];

    protected $hidden = ['type_transaction_id', 'user_id', 'account_id', 'category_id'];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Account()
    {
        return $this->belongsTo(Account::class);
    }

    public function Type_transaction()
    {
        return $this->belongsTo(Type_transaction::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
