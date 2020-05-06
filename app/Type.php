<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $table = 'type';
    protected $guarded = [];

    const MULTIPLE_CHOICE = 1;
    const CHOICES = 2;
    const SIMPLE_TEXT = 3;
}
