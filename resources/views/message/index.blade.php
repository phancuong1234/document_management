@extends('layouts.user.master')
@section('title')
Tin nhắn đến
@endsection
@section('content')
<div class="container">
    <div id="cards-wrapper" class="cards-wrapper row">
        @include("common.errors")
        <div class="list-group" style="margin-top: 0">
        <a href="{{route('message.create')}}" class="btn btn-primary" role="button" style="width: 15%;margin-bottom:10px">Soạn tin nhắn</a>
            <div class="list-group-item" style="margin-bottom: 1%">
                <div class="header-message" >
                    <span width="50px"><input type="checkbox" id="master" style="margin-right: 2%">Chọn / Bỏ chọn tất cả</span>
                    <span style="margin-left: 41%;"> 1 - {{ $getMessages->perPage() }} trong tổng số {{ $getMessages->total() }} tin nhắn đến </span>
                    <div class="button-page">
                        <a href="{{ ($getMessages->currentPage() == 1)? "javascript:void(0)":"/message?page=".($getMessages->currentPage()-1) }}" class="previous round" >&#8249;</a>
                        <a href="{{ ($getMessages->currentPage() == $getMessages->lastPage())? "javascript:void(0)":"/message?page=".($getMessages->currentPage()+1) }}" class="next round">&#8250;</a>
                    </div>
                </div>
            </div>
            {!! Form::open(["method"=>"GET", "route"=>"detele.message", "enctype"=>"multipart/form-data"]) !!}
            @if(count($getMessages)!=0)
                @foreach ($getMessages as $key => $message)
                    @php
                    if($message->is_seen == null){
                        $check = false;
                    }else{
                        $arrSeen = \GuzzleHttp\json_decode($message->is_seen);
                        foreach($arrSeen as $value){
                            if($value == auth()->user()->id){
                                $check = true;
                                break;
                            }
                            else{
                                $check = false;
                            }
                        }
                    }
                    @endphp
                    <div class="list-group-item">
                        <div class="header-message">
                                {!! Form::checkbox('del[]', $message->id, false , ['id' => 'delete-'.$message->id,'style' => "float: left", 'onclick' => "del($message->id)"]) !!}
                                <div class="name-user-message"><a href="">{{ $message->name}}</a></div>
                                @if($check == false)
                                    <div class="new-message"><span>Mới</span></div>
                                @endif
                                <a href="{{ route('message.show',$message->id) }}">
                                    <div class="message-content"><span> {{ $message->title }} </span> </div>
                                </a>
                                <div class="time-message">
                                    <span class="badge" title="{{ date('H:m:i ( d-m-Y )', strtotime($message->created_at)) }}">{{Carbon\Carbon::createFromTimeStamp(strtotime($message->created_at))->diffForHumans()}}</span><br>
                                </div>

                        </div>
                    </div>
                @endforeach
                <div style="text-align: left; margin-top: 10px">
                    {!! Form::submit("Xóa", ["class"=>"btn btn-danger", 'title' => 'xóa tất cả bản ghi đã chon', 'id' => 'del-multi', 'style' => 'display: none;']) !!}
                </div>
            @else
                 <div class="list-group-item">
                    <span>Không có tin nhắn nào </span>
                </div>
            @endif
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
