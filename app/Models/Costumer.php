<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Costumer extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
