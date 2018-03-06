<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePhoto extends Model
{
    //
    protected $table='profile_photos';
    protected $fillable=['user_id','filename'];
    public function user(){
        return $this->belongsTo('App\User');
}
}
