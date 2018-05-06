@extends('layout.default')
@section('title','活动修改')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h5>活动添加</h5>
            </div>
            <div class="panel-body">
                <form method="post" action="{{ route('event.update',$event->id) }}">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="form-group">
                        <label for="name">活动标题：</label>
                        <input type="text" name="title" class="form-control" value="{{ $event->title }}">
                    </div>

                    <div class="form-group">
                        <label for="contents">活动内容：</label>
                        <textarea name="contents" id="container">{{$event->content }}</textarea>
                        <!-- 配置文件 -->
                        <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
                        <!-- 编辑器源码文件 -->
                        <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
                        <!-- 实例化编辑器 -->
                        <script type="text/javascript">
                            var ue = UE.getEditor('container');
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="date">开始时间：</label>
                        <input type="date" name="signup_start" class="form-control" value="{{$event->signup_start}}">
                    </div>
                    <div class="form-group">
                        <label for="password">结束时间：</label>
                        <input type="date" name="signup_end" class="form-control" value="{{ $event->signup_end }}">
                    </div>
                    <div class="form-group">
                        <label for="password">开奖时间：</label>
                        <input type="date" name="prize_date" class="form-control" value="{{ $event->prize_date }}">
                    </div>
                    <div class="form-group">
                        <label for="password">人数限制：</label>
                        <input type="number" name="signup_num" class="form-control" value="{{ $event->signup_num}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">验证码</label>
                        <input id="captcha" class="form-control" name="captcha" >
                        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <button type="submit" class="btn btn-primary">修改</button>
                </form>

                <hr>

            </div>
        </div>
    </div>
@stop