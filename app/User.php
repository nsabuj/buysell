<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function role(){
    return $this->belongsTo('App\Models\Role');
    }

    public function advertisements(){
        return $this->hasMany('App\Advertisement');
    }


    public function profile_pic(){
        return $this->hasOne('App\ProfilePhoto');
    }


    public function user_meta(){
        return $this->hasOne('App\UserMeta');
    }


    public function isSeller(){
            if($this->role->name=="seller"){
                return true;
            }else
            {
               return false;
            }
        }


        public function isAdmin(){
            if($this->role->name=="administrator"){
                return true;
            }else
            {
                return false;
            }
        }

        public function isBuyer(){
            if($this->role->name=="buyer"){
                return true;
            }else
            {
                return false;
            }
        }

}
