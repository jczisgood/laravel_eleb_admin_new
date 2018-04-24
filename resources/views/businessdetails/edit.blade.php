@extends('layout.default')
@section('title','商店详情')
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-info">
                <p>商铺名称{{$businessd->shop_name}}</p>
                <form action="{{ route('businessd.update',$businessd->id)}}" method="post" enctype="multipart/form-data">
                    <br>
                    {{--店铺LOGO:<input class="form-control" type="file" name="shop_img" placeholder="店铺LOGO"><br>--}}
                    <div id="uploader-demo">
                        <!--用来存放item-->
                        <div id="fileList" class="uploader-list"></div>
                        <div id="filePicker">店铺LOGO</div>
                    </div>
                    <div>
                        <img src="" id="img" alt="">
                    </div>
                    <input type="hidden" name="shop_img" value="" id="hidden">
                    {{--                    店铺评分:<input class="form-control" type="text" name="shop_rating" value="{{$businessd->shop_rating}}" placeholder="店铺评分"><br>--}}

                    <label>是否品牌:<input class="form-control" type="checkbox" name="brand" value="1" {{$businessd->brand==1?'checked':''}}></label>
                    <label>是否准时:<input class="form-control" type="checkbox" name="on_time" value="1" {{$businessd->on_time==1?'checked':''}}></label>
                    <label>是否蜂鸟:<input class="form-control" type="checkbox" name="fengniao" value="1" {{$businessd->fengniao==1?'checked':''}}></label>
                    <label>是否保标:<input class="form-control" type="checkbox" name="bao" value="1" {{$businessd->bao==1?'checked':''}}></label>
                    <label>是否票标:<input class="form-control" type="checkbox" name="piao" value="1" {{$businessd->piao==1?'checked':''}}></label>
                    <label>是否准标:<input class="form-control" type="checkbox" name="zhun" value="1" {{$businessd->zhun==1?'checked':''}}></label><br>

                    起送金额:<input class="form-control" type="number" name="start_send" value="{{$businessd->start_send}}" placeholder="起送金额"><br>
                    配送费用:<input class="form-control" type="number" name="send_cost" value="{{$businessd->send_cost}}" placeholder="配送费用"><br>
                    预计时间(分钟):<input class="form-control" type="number" name="estimate_time" value="{{$businessd->estimate_time}}" placeholder="预计时间"><br>
                    小店公告:<textarea class="form-control" name="notice">{{$businessd->notice}}</textarea><br>
                    优惠信息:<textarea class="form-control" name="discount">{{$businessd->discount}}</textarea><br>
                    <input class="form-control" type="submit"><br>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                </form>
            </div>
            {{--<div class="col-sm-3" style="position: relative"><img style="position: absolute;right: 17px;top: 0;" src="{{$businessd->shop_img}}" alt=""></div>--}}
        </div>
@stop
@section('js')
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: '/set',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            formData: {'_token':'{{ csrf_token() }}'},
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        uploader.on( 'uploadSuccess', function( file,response  ) {
//            $( '#'+file.id ).find('p.state').text('已上传');

            $('#img').attr('src',response.file);
            $('#hidden').val(response.file)
        });
    </script>
@stop