<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyContent extends Model
{
    protected $table = 'reply_content';
    protected $casts =[
        'answer' => 'array'
    ];
    protected $guarded = [];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function replyMaster()
    {
        return $this->belongsTo(ReplyMaster::class);
    }
}
