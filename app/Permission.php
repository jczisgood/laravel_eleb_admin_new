<?php

namespace App;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    //白名单
    protected $fillable=[
        'name','display_name','description'
    ];
}
