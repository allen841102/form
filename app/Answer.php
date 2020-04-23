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
}
