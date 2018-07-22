@extends('layouts/backend/auth-form')

@section('content')
<div id="single-wrapper">
    <form action="{{ route('admin.login.submit') }}" class="frm-single" method="post">
        {{ csrf_field() }}
        <div class="inside">
            <div class="title"><strong>Yoyal</strong>Admin</div>
            <!-- /.title -->
            <div class="frm-title">Đăng nhập</div>
            <!-- /.frm-title -->
            @if ($errors->has('email'))
                <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
            @endif
            <div class="frm-input"><input type="text" name="email" placeholder="Username" value="{{ old('email') }}" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>
            <!-- /.frm-input -->

            @if ($errors->has('password'))
                <span class="help-block">
                    {{ $errors->first('password') }}
                </span>
            @endif
            <div class="frm-input"><input type="password" name="password" placeholder="Password" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>
            <!-- /.frm-input -->
            <div class="clearfix margin-bottom-20">
                <div class="pull-left">
                    <div class="checkbox primary"><input type="checkbox" id="rememberme" {{ old('remember') ? 'checked' : '' }} name="remember"><label for="rememberme">Ghi nhớ đăng nhập</label></div>
                    <!-- /.checkbox -->
                </div>
                <!-- /.pull-left -->
{{--                <div class="pull-right"><a href="{{ route('admin.password.request') }}" class="a-link"><i class="fa fa-unlock-alt"></i>Quên mật khẩu?</a></div>--}}
                <!-- /.pull-right -->
            </div>
            <!-- /.clearfix -->
            <button type="submit" class="frm-submit">Đăng nhập<i class="fa fa-arrow-circle-right"></i></button>
            <!-- /.row -->
            <div class="frm-footer">Royal © 2018.</div>
            <!-- /.footer -->
        </div>
        <!-- .inside -->
    </form>
    <!-- /.frm-single -->
</div><!--/#single-wrapper -->
@endsection


{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Admin Login</div>--}}

                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('admin.password.request') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
