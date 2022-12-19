<?php

namespace App\Models;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lend extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'owner_user_id', //bibliotecario
        'customer_user_id',//cliente
        'book_id',
        'date_out',
        'date_in',
        'status',
    ];

  
    public function Book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function Owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id', 'id');
    }

    public function Customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_user_id', 'id');
    }
}
