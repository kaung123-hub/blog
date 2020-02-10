<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['name','email','status','confirmation_code'];
}
