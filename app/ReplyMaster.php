<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyMaster extends Model
{
    protected $table = 'reply_master';
    protected $guarded = [];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function replyContent()
    {
        return $this->hasMany(ReplyContent::class);
    }
}
