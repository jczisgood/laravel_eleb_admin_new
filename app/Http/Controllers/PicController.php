<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use OSS\Core\OssException;

class PicController extends Controller
{
    //
    public function create(Request $request)
    {

//        dd($request->file());
//        dd($_FILES);
        $img_pa=$request->file('file')->store('public/date'.date('md'));
        $img_path = $this->thumb($img_pa,100,100);
//        dd($img_path);
//        $img_name = $_FILES['file']['name'];
//        $img_path = $_FILES['file']['tmp_name'];
//        $img_path=url(Storage::url($res));
        try{
            $client = App::make('aliyun-oss');
            $client->uploadFile(getenv('OSS_BUCKET'),$img_path,Storage_path('App/'.$img_path));
//                echo 1;
            $cover= 'https://laravel-shop-1.oss-cn-beijing.aliyuncs.com/'.$img_path;
//                die();
        }catch (OssException $exception){
            dump($exception->getMessage());
            die;
        }
        return ['file'=>$cover];

    }

}
