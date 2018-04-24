<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable=[
        'title','contents','start_time','end_time'
    ];
}
