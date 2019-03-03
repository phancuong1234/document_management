@extends('layouts.systemAdmin.master')
@section('title')
    Quản lý thanh vien
@endsection
@section('content')
    <div class="main-content-inner">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Progress Table</h4>
                        <a href="{{ route('users.create') }}" class="btn btn-primary">Thêm</a>
                        <div class="single-table">
                            <div class="table-responsive">
                                <table class="table table-hover progress-table text-center">
                                    <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Tên Đầy Đủ</th>
                                        <th scope="col">Giới Tính</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Chức Vụ</th>
                                        <th scope="col">Phòng Ban</th>
                                        <th scope="col">Chức Năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key)
                                    <tr>
                                        <th scope="row">{{ $key->id }}</th>
                                        <td>{{ $key->name }}</td>
                                        <td>{{ ($key->gender == 1)? "Nam":"Nữ" }}</td>
                                        <td><img src="{{ $key->avatar }}"></td>


                                        <td>
                                            {!! Form::open(['method'=>'POST', 'route'=>['users.ajaxps',$key->id], 'id' => 'form-pos'.$key->id]) !!}
                                                {!! Form::select('positions', $position, null, ['class' => 'form-control', 'onchange' => 'pos('.$key->id.')']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            {!! Form::open(['method'=>'POST', 'route'=>['users.ajaxdp',$key->id], 'id' => 'form-dep'.$key->id]) !!}
                                                {!! Form::select('depart', $department, null, ['class' => 'form-control', 'onchange' => 'dep('.$key->id.')']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3" style="margin-top: 10px;"><a href="{{ route('users.show',$key->id) }}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li style="margin-top: 10px;"><a href="javascript:void(0)" class="text-danger"  data-confirm="Ban Co Muon Xoa Ko?"><i class="ti-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy',$key->id], 'id' => 'delete-form']) !!}
                                                    {!! Form::close() !!}
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
