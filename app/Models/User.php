<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Lend;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    // protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number_id',
        'name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password'
    ];

    protected $appends = ['full_name'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    // Accesor (get)
    public function getFullNameAttribute(){
        
        return "{$this->name} {$this->last_name}";

    }

    // Mutador (create - update)
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Relations --------------------------------------------------------------------------------

    public function CustomerLends()
    {
        return $this->hasMany(Lend::class, 'customer_user_id', 'id');
    }

    public function OwnerLends()
    {
        return $this->hasMany(Lend::class, 'owner_user_id', 'id');
    }
    
}
