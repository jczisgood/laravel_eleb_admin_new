@extends('layout.default')
@section('title','用户修改')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>用户修改</h5>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('check.updatemyself',$admin->id) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="username">用户名：</label>
                        <input type="text" name="username" class="form-control" value="{{ $admin->username }}">
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="email" name="email" class="form-control" value="{{ $admin->email }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">验证码</label>
                        <input id="captcha" class="form-control" name="captcha" >
                        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <button type="submit" class="btn btn-primary">修改</button>
                </form>
            </div>
        </div>
    </div>
@stop