<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['eventname', 'datefrom', 'dateto', 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
}
