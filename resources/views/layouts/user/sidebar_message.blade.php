<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="favicon.ico" />
    {{ Html::style(asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')) }}
    {{ Html::style(asset('/templates/user/css/bootstrap.min.css')) }}
    {{ Html::style(asset('/templates/user/css/style.css')) }}
    {{ Html::style(asset('/templates/user/css/styles.css')) }}
    {{ Html::style(asset('/templates/user/css/datepicker.css')) }}
    {{ Html::script(asset('/templates/user/js/jquery-3.2.1.slim.min.js')) }}
    {{ Html::script(asset('/templates/user/js/popper.min.js')) }}
    {{ Html::style(asset('/css/all.css')) }}
    {{ Html::style(asset('/templates/admin/vendor/fontawesome-free/css/all.min.css')) }}
</head>
<body class="landing-page">
<div class="page-wrapper">
    @include('layouts.user.header')
    <section class="cards-section text-center">
        <div class="item item-green col-lg-4 col-6" id="left-bar">
            <div class="leftbar-pending-document">
                <div class="message-leftbar-div">
                    <h4>Tin Nhắn</h4>
                    <div class="search-message">
                        <label>
                            <input autocomplete="off" class="search-message-input" placeholder="Tìm kiếm tin nhắn" spellcheck="false" type="text" aria-label="Tìm kiếm trên Messenger" value="">
                        </label>
                    </div>
                    <div class="overflow-auto message-leftbar">
                        <ul>
                            <a href="{{route('document-department.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến đơn vị
                                </li>
                            </a>
                            <a href="{{route('document-sent.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-upload"></i>&nbsp;
                                    Văn bản đã gửi
                                </li>
                            </a>
                            <a href="{{route('document-pending.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đang chờ duyệt
                                </li>
                            </a>
                            <a href="{{route('document-personal.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến cá nhân
                                </li>
                            </a>
                            <a href="{{route('document-department.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến đơn vị
                                </li>
                            </a>
                            <a href="{{route('document-sent.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-upload"></i>&nbsp;
                                    Văn bản đã gửi
                                </li>
                            </a>
                            <a href="{{route('document-pending.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đang chờ duyệt
                                </li>
                            </a>
                            <a href="{{route('document-personal.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến cá nhân
                                </li>
                            </a>
                            <a href="{{route('document-department.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến đơn vị
                                </li>
                            </a>
                            <a href="{{route('document-sent.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-upload"></i>&nbsp;
                                    Văn bản đã gửi
                                </li>
                            </a>
                            <a href="{{route('document-pending.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đang chờ duyệt
                                </li>
                            </a>
                            <a href="{{route('document-personal.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến cá nhân
                                </li>
                            </a>
                            <a href="{{route('document-department.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến đơn vị
                                </li>
                            </a>
                            <a href="{{route('document-sent.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-upload"></i>&nbsp;
                                    Văn bản đã gửi
                                </li>
                            </a>
                            <a href="{{route('document-pending.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đang chờ duyệt
                                </li>
                            </a>
                            <a href="{{route('document-personal.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến cá nhân
                                </li>
                            </a>
                            <a href="{{route('document-department.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến đơn vị
                                </li>
                            </a>
                            <a href="{{route('document-sent.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-upload"></i>&nbsp;
                                    Văn bản đã gửi
                                </li>
                            </a>
                            <a href="{{route('document-pending.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đang chờ duyệt
                                </li>
                            </a>
                            <a href="{{route('document-personal.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến cá nhân
                                </li>
                            </a>
                            <a href="{{route('document-department.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến đơn vị
                                </li>
                            </a>
                            <a href="{{route('document-sent.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-upload"></i>&nbsp;
                                    Văn bản đã gửi
                                </li>
                            </a>
                            <a href="{{route('document-pending.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đang chờ duyệt
                                </li>
                            </a>
                            <a href="{{route('document-personal.index')}}">
                                <li>
                                    <i class="icon-leftbar fa fa-download"></i>&nbsp;
                                    Văn bản đến cá nhân
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>

{{--                <ul>--}}
{{--                    <a href="{{route('document-department.index')}}">--}}
{{--                        <li>--}}
{{--                            <i class="icon-leftbar fa fa-download"></i>&nbsp;--}}
{{--                            Văn bản đến đơn vị--}}
{{--                        </li>--}}
{{--                    </a>--}}
{{--                    <a href="{{route('document-sent.index')}}">--}}
{{--                        <li>--}}
{{--                            <i class="icon-leftbar fa fa-upload"></i>&nbsp;--}}
{{--                            Văn bản đã gửi--}}
{{--                        </li>--}}
{{--                    </a>--}}
{{--                    <a href="{{route('document-pending.index')}}">--}}
{{--                        <li>--}}
{{--                            <i class="icon-leftbar fa fa-download"></i>&nbsp;--}}
{{--                            Văn bản đang chờ duyệt--}}
{{--                        </li>--}}
{{--                    </a>--}}
{{--                    <a href="{{route('document-personal.index')}}">--}}
{{--                        <li>--}}
{{--                            <i class="icon-leftbar fa fa-download"></i>&nbsp;--}}
{{--                            Văn bản đến cá nhân--}}
{{--                        </li>--}}
{{--                    </a>--}}
{{--                </ul>--}}
            </div>
        </div>
        @yield('content')
    </section>
</div>
@include('layouts.user.footer')
{{ Html::script(asset('/templates/user/js/jquery-3.3.1.min.js')) }}
{{ Html::script(asset('/templates/user/js/bootstrap.min.js')) }}
{{ Html::script(asset('/templates/user/js/stickyfill.min.js')) }}
{{ Html::script(asset('/templates/user/js/main.js')) }}
{{ Html::script(asset('/templates/user/js/myStyle.js')) }}
{{ Html::script(asset('/templates/user/js/bootstrapdatepick.min.js')) }}
{{ Html::script(asset('/templates/user/js/bootstrap-datepicker.js')) }}
{{ Html::script(asset('/js/all.js')) }}
{{ Html::script(asset('/js/app.js')) }}
</body>
</html>


