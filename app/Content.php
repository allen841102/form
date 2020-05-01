<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $guarded = [];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function replyContents()
    {
        return $this->hasMany(ReplyContent::class);
    }
}
