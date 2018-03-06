<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='categories';
    protected $fillable=['name',];

    public function advertisements(){
        return $this->hasMany('App\Advertisement');
    }
}
