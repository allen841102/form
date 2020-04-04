<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public function master()
    {
        return $this->belongsTo('APP\Master');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer');
    }
    protected $table = 'content';
    public $timestamps = false;
    protected $guarded = [];
}
