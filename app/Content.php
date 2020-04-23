<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $guarded = [];

    public function master()
    {
        return $this->belongsTo(Master::class);
    }

    public function answer()
    {
        return $this->hasMany(Answer::class);
    }
}
