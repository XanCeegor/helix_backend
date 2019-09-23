<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Upload extends Model
{
    public function files(){
        return $this->hasMany('App\File');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    protected $guarded = []; // YOLO
}
