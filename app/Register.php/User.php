<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\ServicesModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'gender',
        // 'address',
        'user_type',
        'user_name',
        'full_name',
        'address',
        'email',
        'password',
        'profile_img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isSuperAdmin()
    {
        return $this->user_type == 0;
    }
    public function isAdmin()
    {
        return $this->user_type == 1;
    }
    public function isBHW()
    {
        return $this->user_type == 2;
    }
    public function services()
    {
        return $this->hasMany(ServicesModel::class, 'user_id', 'id');
    }

}
