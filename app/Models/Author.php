<?php

namespace App\Models;

use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        'name',
        'biography',
 
    ];

    public function Books()
    {
        return $this->hasMany(Book::class, 'author_id', 'id');
    }
}
