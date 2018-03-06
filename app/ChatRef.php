<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRef extends Model
{
    //
    protected $table='chat_refs';
    protected $fillable=['chat_id','ref_name','ref_id'];

    public function chat(){
        return $this->belongsTo('App\Chat');
    }
}
