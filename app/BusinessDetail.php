<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    //
    protected $fillable=[
      'shop_img','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','estimate_time',
        'notice','discount'
    ];
}
