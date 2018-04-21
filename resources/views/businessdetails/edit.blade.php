@extends('layout.default')
@section('title','商店详情')
@section('content')
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 bg-info">
                <p>商铺名称{{$businessd->shop_name}}</p>
                <form action="{{ route('businessd.update',$businessd->id)}}" method="post" enctype="multipart/form-data">
                    <br>
                    店铺LOGO:<input class="form-control" type="file" name="shop_img" placeholder="店铺LOGO"><br>

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