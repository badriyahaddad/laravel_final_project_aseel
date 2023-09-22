<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends  Authenticatable  implements Authorizable, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'password',
    ];
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

     public function getJWTIdentifier()
     {
         return $this->getKey();
     }

     public function getJWTCustomClaims()
     {
         return [];
     }
         //Relationships
         public function comment()
         {
             return $this->hasMany(Comment::class.'user_id');
         }
         public function Book()
{
    return $this->hasMany(Book::class,'user_id');
}
}
