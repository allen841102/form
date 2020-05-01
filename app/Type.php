<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    const MULTIPLE_CHOICE = 1;
    const CHOICES = 2;
    const SIMPLE_TEXT = 3;
}
