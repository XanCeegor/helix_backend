<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function upload(){
        return $this->belongsTo(Upload::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $guarded = []; // YOLO

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            $file->{$file->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
