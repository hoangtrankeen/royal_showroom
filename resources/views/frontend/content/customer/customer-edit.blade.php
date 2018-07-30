@extends('frontend/layouts/dashboard')

@section('title', 'Royal')

@section('css')

@endsection

@section('content')
    <form action="{{route('customer.account.update')}}" method="POST">
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <h4 class="mtext-106 cl2 js-name-detail p-b-14">Thông tin tài khoản</h4>
                <div class="form-group">
                    <label for="name">Họ và Tên</label>
                    <input type="text" id="name" name="name" value="{{Auth::user()->name}}">
                    @if ($errors->has('name'))
                        <span class="help-block"> {{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" id="phone" name="phone" value="{{Auth::user()->phone}}">
                    @if ($errors->has('phone'))
                        <span class="help-block"> {{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <!--<div class="form-group">
                    <label for="gender">Giới tính</label>
                    <input type="text" id="gender" name="phone">
                </div>
                <div class="form-group">
                    <label for="birthday">Ngày sinh</label>
                    <input type="text" id="birthday" name="phone">
                </div>-->
                <div class="form-group">
                    <label for="address">Địa chỉ liên hệ</label>
                    <input type="text" id="address" name="address"  value="{{Auth::user()->address}}">
                    @if ($errors->has('address'))
                        <span class="help-block"> {{ $errors->first('address') }}</span>
                    @endif
                </div>
                {{--<div class="form-group checker">--}}
                    {{--<input type="checkbox" id="change-email" name="change-email" onclick="openTarget('email')"><label for="change-email"> Thay đổi Email</label>--}}
                {{--</div>--}}

                <div class="form-group checker">
                    <input type="checkbox" id="change-password" name="change-password" value=""  onclick="openTarget('password')"><label for="change-password"> Thay đổi Mật khẩu</label>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <h4 class="group-change-title mtext-106 cl2 js-name-detail p-b-14">Email và Mật khẩu</h4>
                <div class="form-group group-new-email">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{Auth::user()->email}}">
                    @if ($errors->has('email'))
                        <span class="help-block"> {{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group group-current-password">
                    <label for="current_password">Mật khẩu hiện tại</label>
                    <input type="password" id="current_password" name="current_password">
                    @if ($errors->has('current_password'))
                        <span class="help-block"> {{ $errors->first('current_password') }}</span>
                    @endif
                </div>

                <div class="form-group group-new-password">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" id="new_password" name="new_password">
                    @if ($errors->has('new_password'))
                        <span class="help-block"> {{ $errors->first('new_password') }}</span>
                    @endif
                </div>
                <div class="form-group group-new-password">
                    <label for="new_password_confirmation">Xác nhận mật khẩu</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                </div>
            </div>
            <div class="action col-md-6 col-xs-12 col-lg-6">
                <button type="submit" class=" pull-left block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                    Lưu thông tin
                </button>
            </div>
        </div>

    </form>

@endsection

@section('javascript')

@endsection
