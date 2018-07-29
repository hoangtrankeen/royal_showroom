@extends('backend/layouts/master')

@section('title','Create Product')

@section('css')
    <!-- Datepicker -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datepicker/css/bootstrap-datepicker.min.css')}}">

    <!-- DateRangepicker -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/daterangepicker/daterangepicker.css')}}">
    <!-- Select2 -->
    <!-- Remodal -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/modal/remodal/remodal.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/modal/remodal/remodal-default-theme.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugin/select2/css/select2.min.css')}}">

    <!-- Data Tables -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datatables/media/css/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css')}}">
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box-content">
                <h4 class="box-title">View Order</h4>
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                    <ul class="sub-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else there</a></li>
                        <li class="split"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.box-title -->
                <div class="card-content">
                    <form id="send-email" action="{{ route('admin.order.email') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="order_id" value="{{$order->id}}">
                    </form>

                    <form class="form-horizontal" action="{{route('order.update', $order->id)}}" id="topic" method="post">
                        <div class="box-content">
                            @foreach($statuses as $status)

                                @if($order->statuses->id == $status->id)
                                    <input type="submit" class="btn btn-success" name="status_{{$status->id}}" value="{{$status->name}}">
                                @else
                                    <input type="submit" class="btn btn-light" name="status_{{$status->id}}" value="{{$status->name}}">
                                @endif
                            @endforeach


                            <input type="submit" class="btn btn-danger pull-right" value="Cập nhật đơn hàng">


                            <a href="{{ route('admin.order.email') }}" class="btn btn-info pull-right"
                               onclick="event.preventDefault();
                                                     document.getElementById('send-email').submit();">
                                <i class="fa fa-send-o" aria-hidden="true"></i> Gửi Email
                            </a>

                        </div>

                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box-content">
                                    <h4 class="box-title">Order # {{$order->id}}</h4>
                                    <table class="table">
                                        <tr>
                                            <th>Ngày đặt hàng</th>
                                            <td>{{presentDate($order->created_at)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Trạng thái</th>
                                            <td>{{$order->statuses->name}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-content">
                                    <h4 class="box-title">Thông tin khách hàng</h4>
                                    <table class="table">
                                        <tr>
                                            <th>Tên</th>
                                            <td>{{($order->user_id) ? $order->customer->name : $order->billing_name}} </td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{$order->billing_email}}</td>
                                        </tr>
                                        <tr>
                                            <th>Loại</th>
                                            <td>{{ ($order->user_id) ? 'Có tài khoản' : 'không đăng nhập' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Di động</th>
                                            <td>{{$order->billing_phone}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-content">
                                    <h4 class="box-title">Địa chỉ nhận hàng</h4>
                                    <table class="table">
                                        <tr>
                                            <th>Địa chỉ</th>
                                            <td>
                                                <input type="text" name="billing_address" value="{{$order->billing_address}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tỉnh/Thành phố</th>
                                            <td>
                                                <input type="text" name="billing_city" value="{{$order->billing_city}}">
                                            </td>
                                        </tr><tr>
                                            <th>Quận/ Huyện</th>
                                            <td>
                                                <input type="text" name="billing_province" value="{{$order->billing_province}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Postal Code</th>
                                            <td>
                                                <input type="text" name="billing_postalcode" value="{{$order->billing_postalcode}}">
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="box-content">
                                    <h4 class="box-title">Phương thức thanh toán</h4>
                                    <table class="table">
                                        <tr>
                                            <th>{{$order->payment_methods->name}}</th>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box-content">
                                    <h4 class="box-title">Thông tin thêm</h4>
                                    <table class="table">
                                        <tr>
                                            <th>Ngày nhận hàng</th>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="delivery_date" value="{{($order->delivery_date)}}">
                                                    <span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="box-content">
                                <h4 class="box-title">Sản phẩm</h4>
                                <table class="table">
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                    </tr>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->pivot->quantity}}</td>
                                        <td>{{presentPrice($product->final_price * $product->pivot->quantity)}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <th>Tổng</th>
                                        <td></td>
                                        <td>{{presentPrice($order->billing_total)}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        {{--<div class="form-group">--}}
                            {{--<label for="categories" class="col-sm-2 control-label">Parent Topic</label>--}}
                            {{--<div class="col-sm-8">--}}
                                {{--<select class=" topic form-control" id="parent_id" name="parent_id">--}}
                                    {{--<option value="0">-----</option>--}}
                                    {{--@foreach($categories as $category)--}}
                                        {{--<option value="{{$category->id}}" {{($category->id) == ($thiscat->parent_id) ? 'selected':'' }}>{{$category->name}}</option>--}}
                                        {{--@if(count($category->children))--}}
                                            {{--@include('backend/topic/in_edit',['children' => $category->children, 'html'=>''])--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </form>
                </div>
                <!-- /.card-content -->
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-lg-6 col-xs-12 -->
    </div>

@endsection

@section('javascript')
    <!-- Select2 -->
    <script src="{{asset('backend/assets/plugin/select2/js/select2.min.js')}}"></script>

    <!-- Multi Select -->
    <script src="{{asset('backend/assets/plugin/multiselect/multiselect.min.js')}}"></script>

    <!-- Data Tables -->
    <script src="{{asset('backend/assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
    <script src="{{asset('backend/assets/scripts/datatables.demo.min.js')}}"></script>
    <!-- Timepicker -->
    <script src="{{asset('backend/assets/plugin/timepicker/bootstrap-timepicker.min.js')}}"></script>

    <!-- Colorpicker -->
    <script src="{{asset('backend/assets/plugin/colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

    <!-- Datepicker -->
    <script src="{{asset('backend/assets/plugin/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $('#datepicker').datepicker({
            date: new Date()
        });
    </script>
@endsection