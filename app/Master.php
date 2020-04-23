<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    const STATUS_ACTIVE = 'Active';

    protected $table = 'Master';
    protected $guarded = [];

    public function contents()
    {
        return $this->hasMany(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
