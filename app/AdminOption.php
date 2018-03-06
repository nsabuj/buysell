<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminOption extends Model
{
    //
    protected $table='admin_options';
    protected $fillable=['optionname','value'];

    public function getoption($key){
        $val=AdminOption::where('optionname', $key)->firstOrFail();
        return $val->value;
    }
}
