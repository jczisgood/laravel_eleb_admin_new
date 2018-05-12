<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use OSS\Core\OssException;

class PicController extends Controller
{
    //
    // /www/wwwroot/admin_eleb/vendor/intervention/image/src/Intervention/Image/AbstractDecoder.php on line 345
    public function create(Request $request)
    {
        $img_pa=$request->file('file')->store('public/date'.date('md'));
        $img_path = $this->thumb($img_pa,100,100);
        try{
            $client = App::make('aliyun-oss');
            $client->uploadFile(getenv('OSS_BUCKET'),$img_path,Storage_path('app/'.$img_path));
//                echo 1;$img_path
            $cover= 'https://laravel-shop-1.oss-cn-beijing.aliyuncs.com/'.$img_path;
//                die();
        }catch (OssException $exception){
            dump($exception->getMessage());
            die;
        }
        return ['file'=>$cover];

    }

}
