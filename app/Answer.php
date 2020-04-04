<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function content()
    {
        return $this->belongsTo('APP\Content');
    }

    public function type()
    {
        return $this->hasOne('APP\Type');
    }
    protected $table = 'answer';
    public $timestamps = false;
    protected $guarded = [];
}
