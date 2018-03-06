<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    //

    protected $table='chat_messages';
    protected $fillable=['chat_id','sender_id','message'];

    public function chat(){
        return $this->belongsTo('App\Chat');
    }
}
