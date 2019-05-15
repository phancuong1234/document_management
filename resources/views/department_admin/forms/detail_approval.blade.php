@extends('layouts.user.master')
@section('title')
    Biễu Mẫu Đang Chờ Phê Duyệt
@endsection
@section('content')
    <div class="container">
        <div id="cards-wrapper" class="cards-wrapper row detail-document-body">
            <div style="margin: 10px;width: 100%;;text-align: left">
                @if(isset($form))
                    <div class="detail-head">
                        <h4 style="color:black">{{ $form->name }}</h4>
                        <br>
                        <div class="content-document">
                            <p>{{ $form->description }}</p>
                        </div><br><div class="line"></div>
                        <div>
                            <div style="margin: 5px 10px;">
                                @foreach($arrayFileDecode as $value)
                                    <div class="preview1">
                                        <a href="/upload/files/form/{{ $value }}" download style="color:black;">
                                            @php
                                                $path = pathinfo($value,PATHINFO_EXTENSION);
                                            @endphp
                                            @if($path == 'docx' || $path == 'doc')
                                                <span class="preview__name files filesfix" style="font-size: 13px" title="{{ $value }}"><i class="fas fa-file-word"></i> {{ $value }}</span>
                                            @else
                                                <span class="preview__name files filesfix" style="font-size: 13px" title="{{ $value }}"><i class="fas fa-file-pdf"></i> {{ $value }}</span>
                                            @endif
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button class="btn btn-primary" onclick="acceptApproval('acceptApproval'+{{$form->id }}, 'biểu mẫu')">Chấp Nhận</button>
                        <button class="btn btn-danger" onclick="cancelApproval('cancelApproval'+{{ $form->id }}, 'biểu mẫu')">Từ Chối</button>
                        {!! Form::open(['method'=>'PUT', 'route'=>['forms.approval.accept',$form->id], 'id' => 'acceptApproval'.$form->id]) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['method'=>'PUT', 'route'=>['forms.approval.cancel',$form->id], 'id' => 'cancelApproval'.$form->id]) !!}
                        {!! Form::close() !!}
                        <div class="clear"></div>
                    </div>
                @endif
            </div>
        </div>

    </div>
    {{ Html::script(asset('/templates/user/js/attach-file.js')) }}
@endsection
