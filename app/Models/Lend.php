<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lend extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_user_id',
        'customer_user_id',
        'book_id',
        'date_out',
        'date_in',
        'status',
    ];
}
