<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Chat extends Model
{
    //
    protected $table='chats';
    protected $fillable=['user1','user2'];

    public function messages(){
        return $this->hasMany('App\ChatMessage');
    }

    public function ref(){
        return $this->hasOne('App\ChatRef');
    }
}
