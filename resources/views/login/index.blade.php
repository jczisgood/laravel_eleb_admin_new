@extends('layout.default')
@section('title','商家登录')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>超级管理员登录</h5>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input type="text" name="username" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">记住我：</label>
                        <input type="checkbox" name="rememberMe" value="1">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">验证码</label>
                        <input id="captcha" class="form-control" name="captcha" >
                        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>

                    <button type="submit" class="btn btn-primary">登录</button>
                </form>
                <hr>
            </div>
        </div>
    </div>
@stop