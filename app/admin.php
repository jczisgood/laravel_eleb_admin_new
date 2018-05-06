<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;

class admin extends Authenticatable
{
    use LaratrustUserTrait;
    protected $fillable=[
        'username', 'email', 'password',
    ];
}
