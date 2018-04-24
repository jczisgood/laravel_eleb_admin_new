<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function thumb($filename,$width=100,$height=100)
    {
        $paths = pathinfo(Storage::url($filename));

        $i_mg = $paths['filename'].'_'.$width.'X'.$height.'.'.$paths['extension'];

        $img = Image::make(public_path().Storage::url($filename))->resize($width, $height);

        $img->save(public_path().$paths['dirname'].'/'.$i_mg);

        return dirname($filename).'/'.$i_mg;
    }
}
