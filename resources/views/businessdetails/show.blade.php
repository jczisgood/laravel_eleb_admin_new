@extends('layout.default')
@section('title','显示')
@section('content')
        <div class="panel panel-warning">
            <a class="btn btn-group" href="{{route('businessd.edit',$businessd->id)}}">完善商品信息</a>
            <h2 class="bg-primary">商铺名称:{{ $businessd->shop_name }}</h2>
            <div class="container">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10" style="position: relative;">
                        <ul class="list-group">
                            <li>店铺LOGO:<img style="position: absolute;right: 0;" src="{{$businessd->shop_img}}" alt="" width="100px"></li>
                            <li>店铺评分:&emsp;{{$businessd->shop_rating}}</li>
                            <li>是否品牌:&emsp;{{$businessd->brand==0?'否':'是'}}</li>
                            <li>是否准时:&emsp;{{$businessd->on_time==0?'否':'是'}}</li>
                            <li>是否蜂鸟:&emsp;{{$businessd->fengniao==0?'否':'是'}}</li>
                            <li>是否保标:&emsp;{{$businessd->bao==0?'否':'是'}}</li>
                            <li>是否票标:&emsp;{{$businessd->piao==0?'否':'是'}}</li>
                            <li>是否准标:&emsp;{{$businessd->zhun==0?'否':'是'}}</li>
                            <li>起送金额:&emsp;{{$businessd->start_send}}</li>
                            <li>配送费用:&emsp;{{$businessd->send_cost}}</li>
                            <li>预计时间:&emsp;{{$businessd->estimate_time}}</li>
                            <li>小店公告:&emsp;{{$businessd->notice}}</li>
                            <li>优惠信息:&emsp;{{$businessd->discount}}</li>
                        </ul>
                    </div>
                    <div class="col-sm-1"></div>
                </div>
            </div>
        </div>
@stop