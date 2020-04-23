<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';
    protected $guarded = [];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function type()
    {
        return $this->hasOne(Type::class);
    }
}
