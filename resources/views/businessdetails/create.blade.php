@extends('layout.default')
@section('title','店铺添加')
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="container col-lg-9" style="background-color: #eceeee">
            <br/>
            <form  method="post" action="{{ route('businessd.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    <label>店铺名称</label>
                    <input type="text" class="form-control" placeholder="商户名" name="shop_name" value="{{ old('shop_name') }}">
                </div>
                <div class="form-group">
                    <label>店主姓名</label>
                    <input class="form-control" name="owner" placeholder="商户姓名" value="{{ old('owner') }}" />
                </div>
                <div class="form-group">
                    <label>联系电话</label>
                    <input class="form-control" name="phone" placeholder="手机号" value="{{ old('phone') }}" />
                </div>
                <div class="form-group">
                    <label>密码</label>
                    <input type="password" class="form-control" name="password" placeholder="密码">
                </div>
                <div class="form-group">
                    <label>确认密码</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码">
                </div>

                <div class="form-group">
                    <label>邮箱</label>
                    <input type="email" class="form-control" name="email" placeholder="email" value="{{old('email')}}">
                </div>

                <div class="form-group">
                    <label>店铺分类</label>
                    <select class="form-control" name="categories_id">
                        <option value="">--选择分类--</option>
                        @foreach($categories as $key=>$category)
                            <option value="{{$key}}">{{$category}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">店铺LOGO</div>
                </div>
                <div>
                    <img src="" id="img" alt="" width="100px">
                </div>
                <input type="hidden" name="cover" value="" id="hidden">
                <div class="form-group">
                    <label>店铺地址</label>
                    <input type="text" class="form-control" name="address" value="{{old('address')}}" >
                </div>
                <div class="form-group">
                    <label>评 分</label>
                    <input type="number" class="form-control" name="shop_rating" value="{{old('shop_rating')}}" >
                </div>

                <table border="1px" width="400px">
                    <tr>
                        <td><label>是否品牌</label></td>
                        <td>是: <input type="radio" name="brand" value="1">&emsp;</td>
                        <td>否: <input type="radio" name="brand" value="0" checked="checked"></td>
                    </tr>
                    <td><label>是否准时送达</label></td>
                    <td>是: <input type="radio" name="on_time" value="1" checked="checked"></td>
                    <td>否: <input type="radio" name="on_time" value="0" ></td>
                    <tr>
                        <td><label>是否蜂鸟配送&emsp;</label></td>
                        <td>是: <input type="radio" name="fengniao" value="1"></td>
                        <td>否: <input type="radio" name="fengniao" value="0" checked="checked"></td>
                    </tr>
                    <tr>
                        <td><label>是否保标记&emsp;</label></td>
                        <td>是: <input type="radio" name="bao" value="1"></td>
                        <td>否: <input type="radio" name="bao" value="0" checked="checked"></td>
                    </tr>
                    <tr>
                        <td> <label>是否有发票&emsp;</label></td>
                        <td>是: <input type="radio" name="piao" value="1"></td>
                        <td> 否: <input type="radio" name="piao" value="0" checked="checked"></td>
                    </tr>
                    <tr>
                        <td><label>是能准时发货</label></td>
                        <td>是: <input type="radio" name="zhun" value="1"></td>
                        <td>否: <input type="radio" name="zhun" value="0" checked="checked"></td>
                    </tr>
                </table>

                <div class="form-group">
                    <label>起送金额</label>
                    <input type="text" name="start_send" class="form-control" value="{{old('start_send')}}">
                </div>

                <div class="form-group">
                    <label>配送费</label>
                    <input type="text" name="send_cost" class="form-control" value="{{old('send_cost')}}">
                </div>

                <div class="form-group">
                    <label>配送距离</label>
                    <input type="text" name="distance" class="form-control" value="{{old('distance')}}">
                </div>

                <div class="form-group">
                    <label>预计时间</label>
                    <input type="text" name="estimate_time" class="form-control" value="{{old('estimate_time')}}">
                </div>
                <div class="form-group">
                    <label>店铺公告</label>
                    <textarea name="notice" maxlength="50" class="form-control" rows="3" placeholder="新店开张，优惠大酬宾！">{{ old('notice') }}</textarea>
                </div>

                <div class="form-group">
                    <label>优惠信息</label>
                    <textarea name="discount" class="form-control" rows="3" placeholder="新用户有巨额优惠" maxlength="50">{{ old('discount') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">验证码</label>
                    <input id="captcha" class="form-control" name="captcha" >
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                </div>
                {{csrf_field()}}
                <button type="submit" class="btn btn-primary btn-success">添加</button>
            </form>
        </div>
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
