<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    //
    protected $table='advertisements';
    protected $fillable=['user_id','title','price','category_id','city','description','expires'];

public function category(){
       return $this->belongsTo('App\Category');
}

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function  photos(){
        return $this->hasMany('App\AdvertisementsPhoto', 'advertisement_id', 'id');
    }

    public function payment_details(){
        return $this->hasOne('App\PaymentDetails');
    }
}
