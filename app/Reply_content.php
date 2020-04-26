<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply_content extends Model
{
    protected $table = 'reply_content';
    protected $guarded = [];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function reply_master()
    {
        return $this->belongsTo(Reply_master::class);
    }
}
