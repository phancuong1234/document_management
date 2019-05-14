@extends('layouts.user.master')
@section('title')
    Danh sách đang chờ duyệt
@endsection
@section('content')
    <div class="container">
        <div id="cards-wrapper" class="cards-wrapper row" >
            <div class="card-header py-3" style="margin-bottom: 18px !important;margin: 0px auto;">
                <h6 class="m-0 font-weight-bold text-primary">Danh Sách Biễu Mẫu Đang Chờ Phê Duyệt</h6>
            </div>
            <div class="list-group" style="width: 95%;">
                @if($form->count() == 0)
                    <div class="list-group-item" >
                        Không có biễu mẫu nào đang chờ duyệt.
                    </div>
                @endif
                @foreach($form as $value)
                    <div class="list-group-item" style="position: relative;" >
                        <a href="{{ route('forms.approval.detail',$value->id) }}" title="{{ $value->name }}" >
                            <span class="name" style="max-width: 25% !important;color: black; border-right: 2px solid;padding-right: 16px;">{{ $value->name }}</span>
                            <span class="float-left" style="width: 50%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;text-align: left !important;">
                                <span class="text-muted"><span style="color: black;">Trích yếu nội dung: {{ $value->description }}</span></span>
                            </span>
                            <span class="badge">{{ $value->created_at }}</span>
                        </a>
                        {!! Form::open(['method'=>'PUT', 'route'=>['forms.approval.accept',$value->id], 'id' => 'acceptApproval'.$value->id]) !!}
                        <a href="javascript:void(0)" onclick="acceptApproval('acceptApproval'+{{$value->id }}, 'biểu mẫu')" style="position: absolute;top:-2%;right: -30px"><i class="fas fa-check-circle" style="font-size: 20px;color: green" ></i></a>
                        {!! Form::close() !!}
                        {!! Form::open(['method'=>'PUT', 'route'=>['forms.approval.cancel',$value->id], 'id' => 'cancelApproval'.$value->id]) !!}
                        <a href="javascript:void(0)" onclick="cancelApproval('cancelApproval'+{{ $value->id }}, 'biểu mẫu')" style="position: absolute;bottom:-2%;right: -30px"><i class="fas fa-ban" style="font-size: 20px;color:red" ></i></a>
                        {!! Form::close() !!}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
