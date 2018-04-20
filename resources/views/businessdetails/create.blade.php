@extends('layout.default')
@section('title','注册店铺')
@section('content')
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

                <div class="form-group">
                    <label>店铺图片</label>
                    <input  type="file"  name="shop_img"/>
                </div>
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
                <button type="submit" class="btn btn-primary btn-success">注册</button>
            </form>
        </div>
    </div>
@stop
