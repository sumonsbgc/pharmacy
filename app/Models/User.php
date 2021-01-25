<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',
        'password',
        'username',
        'mobile',
        'profile_pic',
        'gender',
        'birthdate',
        'country',
        'city',
        'address',
        'last_login_ip',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function categories(){
        return $this->hasMany(Category::class);        
    }

    public function brands(){
        return $this->hasMany(Brand::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function suppliers(){
        return $this->hasMany(Supplier::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}