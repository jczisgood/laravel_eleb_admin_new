@extends('layout.default')
@section('title','商家修改')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>商家注册</h5>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('businessusers.update',$businessuser->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input type="text" name="name" class="form-control" value="{{ $businessuser->name }}">
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="password">密码：</label>--}}
                        {{--<input type="password" name="password" class="form-control" value="{{ $businessuser->password }}">--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label for="password">确认密码：</label>--}}
                        {{--<input type="password" name="password_confirmation" class="form-control" value="{{$businessuser->password }}">--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label for="password">邮箱：</label>
                        <input type="email" name="email" class="form-control" value="{{$businessuser->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">审核状态：</label>
                        通过:<input type="checkbox" name="status" value="1" @if($businessuser->status==1)checked="checked"@endif>
                        不通过:<input type="checkbox" name="status"  value="0" @if($businessuser->status==0)checked="checked"@endif>
                    </div>
                    <div class="form-group">
                        <label for="password">产品分类：</label>
                        <select name="category_id" id="cate" zz="{{$businessuser->category_id}}">
                            @foreach($categories as $key=>$category)
                            <option value="{{$category}}">{{$key}}</option>
                            {{--<option value="2">午餐</option>--}}
                            {{--<option value="3">晚餐</option>--}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">验证码</label>
                        <input id="captcha" class="form-control" name="captcha" >
                        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <a href="{{route('businessd.show',['businessd'=>$businessuser->user_id])}}" class="btn btn-primary">去详细信息</a>
                    <button type="submit" class="btn btn-primary">修改</button>
                </form>

                <hr>

            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        var user_id=$('#cate').attr('zz');
//      confirm(user_id);
        $('#cate').val(function () {
            return user_id;
        });
    </script>
@stop