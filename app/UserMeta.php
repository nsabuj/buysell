<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    //
    protected $table='user_metas';
    protected $fillable=['user_id','ip','phone'];

    public function user(){
        return $this->belongsTo('App\User');
    }

}
