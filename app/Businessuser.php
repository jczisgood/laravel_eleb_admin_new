<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Businessuser extends Model
{
    //
    protected $fillable=[
        'phone','name','password','category_id','status','user_id'
    ];
    public function category()
    {
        return $this->belongsTo(BusinessCategory::class,'category_id');
    }
}
