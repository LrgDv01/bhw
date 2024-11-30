<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

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
        // 'valid_id',
        // 'middle_name',
        // 'last_name',
        // 'gender',
        // 'address',
        'profile_img',
        'user_name',
        'full_name',
        'contact',
        'email',
        'password',
        'user_type',
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
    public function isAdmin()
    {
        // Define your logic here to check if the user is an administrator
        // For example, if you have an 'role' column in your users table
        // and 'admin' is one of the roles that indicates administrator,
        // you can check if the role is 'admin' like this:
        return $this->user_type == 0;
    }
    public function isFarmer()
    {
        // Define your logic here to check if the user is an administrator
        // For example, if you have an 'role' column in your users table
        // and 'admin' is one of the roles that indicates administrator,
        // you can check if the role is 'admin' like this:
        return $this->user_type == 1;
    }

    
    public function isTechnician()
    {
        // Define your logic here to check if the user is an administrator
        // For example, if you have an 'role' column in your users table
        // and 'admin' is one of the roles that indicates administrator,
        // you can check if the role is 'admin' like this:
        return $this->user_type == 2;
    }
    // public function module_access() {
    //     $get_module_access = ModuleAccessModel::select('module_code')->where('userID', $this->id)->get();
    //     $get_module_access = $get_module_access->toArray();
    //     $ret = [];
    //     foreach($get_module_access as $code) {
    //         $ret[] = $code['module_code'];
    //     }
    //     return $ret;
    // }   
    // public function get_qr(){
    //     $get_qr = QrModel::where('userID', $this->id)->first();
    //     return $get_qr['code'];
    // }
    
    // public function isBlocked() {
    //     return BlockedAccountModel::where('userID', $this->id)->exists();
    // }
    
    // public function qrs()
    // {
    //     return $this->hasMany(QrModel::class, 'userID');
    // }
    // public function notifications()
    // {
    //     return $this->hasMany(NotificationModel::class, 'user_id');
    // }
    
    public function feedback()
    {
        return $this->hasMany(FeedbackModel::class, 'user_id');
    }

    public function farms()
    {
        return $this->hasMany(Farm::class);
    }
}
