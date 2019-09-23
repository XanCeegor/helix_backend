<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = []; // YOLO

    public function upload(){
        return $this->belongsTo('App\Upload');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
