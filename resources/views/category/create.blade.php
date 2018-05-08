@extends('layout.default')
@section('title','分类添加')
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form action="{{route('businesscategory.store')}}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" name="name" value="{{old('name')}}">
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
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">提交</button>
    </form>
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