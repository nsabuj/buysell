<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    protected $table='payment_details';
    protected $fillable=['advertisement_id','title','amount','status','payment_id','payment_method'];

    public function advertisement(){
        return $this->belongsTo('App\Advertisement');
    }
}
