<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementsPhoto extends Model
{
    //
    protected $table='advertisements_photos';
    protected $fillable = ['advertisement_id', 'filename'];

    public function advertisement()
    {
        return $this->belongsTo('App\Advertisement');
    }
}
