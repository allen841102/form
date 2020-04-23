<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    public function content()
    {
        return $this->hasMany(Content::class);
    }
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
    protected $table = 'Master';
    public $timestamps = false;
    protected $guarded = [];
}
