@extends('layouts.user.master')
@section('title')
    Chi tiết văn bản
@endsection
@section('content')
    <div class="container">
        <div id="cards-wrapper" class="cards-wrapper row detail-document-body">
            <div style="margin: 10px;width: 100%;;text-align: left">
                <div class="detail-head">
                    @include("common.errors")
                    <div>
                        @if($getMessages->avatar == 'user-default.png')
                            <img src="/templates/img/user/{{$getMessages->avatar}}" style="width: 35px;height: 35px;border-radius: 2em;">&nbsp;
                        @else
                            <img src="/upload/images/{{$getMessages->avatar}}" style="width: 35px;height: 35px;border-radius: 2em;">&nbsp;
                        @endif
                        <span style="color: black;font-weight: bold">{{$getMessages->name}}</span>
                        <div style="float: right"><span>{{$getMessages->created_at}}</span>&nbsp;
                            <button class="pulse-button" id="show" title="Trả lời"><i class="fa fa-reply"></i></button>
                        </div>
                    </div>
                    <br>
                    <div class="content-document">
                        <p>{{$getMessages->content}}</p>
                    </div>
                    <br>
                    <div class="line"></div>
                <div>
                    <div class="upload__files">
                        @foreach($getAttachedFile as $key => $attachedFile)
                            <a href="/upload/files/message/{{$attachedFile->name}}" download class="preview"><span class="preview__name" style="font-size: 13px;" title="{{$attachedFile->name}}">{{$attachedFile->name}}</span></a>
                        @endforeach
                    </div>
                </div>
                    <div>
                        @foreach($getReplyMessages as $value)
                            <div class="reply_message_right {{ ($value->sender_id == auth()->user()->id)?"reply-message":"" }} ">
                                <div class="detail-head">
                                    <div style="padding-top: 10px;">
                                        @if($value->avatar == 'user-default.png')
                                            <img src="/templates/user/images/{{$value->avatar}}" style="width: 35px;height: 35px;border-radius: 2em;">&nbsp;
                                        @else
                                            <img src="/upload/images/{{$value->avatar}}" style="width: 35px;height: 35px;border-radius: 2em;">&nbsp;
                                        @endif
                                        <span style="color: black;font-weight: bold">{{ $value->name }}</span>
                                        <div style="float: right"><span title="{{ date('H:m:i ( d-m-Y )', strtotime($value->created_at)) }}">
                                                {{Carbon\Carbon::createFromTimeStamp(strtotime($value->created_at))->diffForHumans()}}</span>&nbsp;
                                        </div>
                                    </div>
                                    <div>
                                        <h4 style="padding-left: 10px;color: red;">Tiêu Đề: {{ $value->title }}</h4>
                                    </div>
                                    <div class="content-document">
                                        <p style="padding-left: 10px">{{ $value->content }}</p>
                                    </div>
                                    <br>
                                    <div class="line" style="max-width: 98%;margin: 0 auto;"></div>
                                    <div>
                                        <div style="margin: 5px 10px;">
                                            @php
                                                $getAttachedFileReply = \App\Models\MessageAttachments::where('messages_id', $value->id)->get();
                                            @endphp
                                            @if(isset($getAttachedFileReply))
                                                @foreach($getAttachedFileReply as $value)
                                                    @php
                                                        $path = pathinfo($value->name,PATHINFO_EXTENSION);
                                                    @endphp
                                                    <div class="preview1">
                                                        <a href="/upload/files/document_reply/{{ $value->name }}" download style="color:black;">
                                                            @if($path == 'docx' || $path == 'doc')
                                                                <span class="preview__name files filesfix" title="{{ $value->name }}"><i class="fas fa-file-word"></i> {{ $value->name }}</span>
                                                            @else
                                                                <span class="preview__name files filesfix" title="{{ $value->name }}"><i class="fas fa-file-pdf"></i> {{ $value->name }}</span>
                                                            @endif
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                <button type="button" class="btn btn-light rep-bot-button"><i class="fa fa-reply"></i>&nbsp;Trả lời</button>
                <div class="reply display-none" id="rep-area">
                    {!! Form::open(['method'=>'POST', 'route'=>['reply-message', $getMessages->id], 'files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('title', 'Tiêu đề', []) !!}
                            {!! Form::text('title', '', ['class'=>'form-control', 'id'=>'title', 'placeholder'=>'Nhập tiêu đề...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('content', 'Nội dung', []) !!}
                            {!! Form::text('content', '', ['id'=>'content', 'class'=>'form-control', 'placeholder'=>'Nhập nội dung...']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::file('attachedFiles[]', ['class'=>'form-control-file', 'multiple']) !!}
                        </div>
                        {!! Form::submit('Gửi', ['class'=>'btn btn-primary']) !!}
                        <a class="fa fa-trash close-rep-area"></a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    {{ Html::script(asset('/templates/user/js/attach-file.js')) }}
@endsection
