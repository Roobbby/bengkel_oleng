<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function transaction_details(){
        return $this->hasMany(TransactionDetail::class);
    }
    public function deleteTransactionWithDetails()
    {
        $this->transaction_details()->delete();

        $this->delete();
    }
}
