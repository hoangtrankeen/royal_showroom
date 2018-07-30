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
                <h4 class="box-title">Tạo đơn hàng</h4>
                <div class="row">
                    <div class="container">
                        <button type="button" class=" pull-right btn btn-success margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-2">Chọn sản phẩm</button>
                    </div>
                </div>

                <!-- /.box-title -->
                <div class="card-content">
                    <div class="row">
                        <div class="col-md-7">
                            <form id="send-email" action="{{ route('order.store') }}" method="POST" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Họ Tên*</label>
                                    <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" required />
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" required />
                                    @if ($errors->has('email'))
                                        <span class="help-block"> {{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="phone">Số điện thoại*</label>
                                    <input type="tel" name="phone" id="phone" value="{{old('phone')}}" class="form-control" required />
                                    @if ($errors->has('phone'))
                                        <span class="help-block"> {{ $errors->first('phone') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="city">Tỉnh/ Thành phố*</label>
                                    <input type="text" name="city" id="city" value="{{old('city')}}" class="form-control" required />
                                    @if ($errors->has('city'))
                                        <span class="help-block"> {{ $errors->first('city') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="province">Quận/ Huyện*</label>
                                    <input type="text" name="province" id="province" value="{{old('province')}}" class="form-control" required />
                                    @if ($errors->has('province'))
                                        <span class="help-block"> {{ $errors->first('province') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ nhận hàng(Số nhà, ngõ...)*</label>
                                    <input type="text" name="address" id="address" value="{{old('address')}}" class="form-control" required />
                                    @if ($errors->has('address'))
                                        <span class="help-block"> {{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="postalcode">Postal Code</label>
                                    <input type="text" name="postalcode" id="postalcode" value="{{old('postalcode')}}" class="form-control" required />
                                    @if ($errors->has('postalcode'))
                                        <span class="help-block"> {{ $errors->first('postalcode') }}</span>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <label for="delivery_date">Ngày nhận hàng</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="delivery_date" value="{{old('delivery_date')}}">
                                        <span class="input-group-addon bg-primary text-white"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    @if ($errors->has('delivery_date'))
                                        <span class="help-block"> {{ $errors->first('delivery_date') }}</span>

                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="payment_method">Phương thức thanh toán</label>
                                    @foreach($payments as $payment)
                                        <div class="checkbox-payment">
                                            <label>
                                                <input type="checkbox" name="payment_method" value="{{$payment->id}}" class="payment_method"/>
                                                {{$payment->name}}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>

                                <input type="hidden" id="order_product" name="order_product[]">

                                <button class="btn btn-info">Xác nhận tạo đơn hàng</button>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="box-content">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng </th>
                                        <th>Giá</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(Cart::content() as $item)
                                        <tr>
                                            <td>
                                                <img src="{{getProductImage($item->model->images)}}" width="80" alt="">
                                            </td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>{{presentPrice($item->total)}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Tổng</th>
                                        <td></td>
                                        <td>{{Cart::count()}}</td>
                                        <td>{{presentPrice(Cart::total())}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-content -->
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-lg-6 col-xs-12 -->
    </div>

@endsection

@section('modal')
    <div class="modal fade" id="boostrapModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel-1">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="row small-spacing">
                        <div class="col-xs-12">
                            <div class="box-content">
                                <h4 class="box-title">Default</h4>
                                <!-- /.box-title -->
                                <!-- /.dropdown js__dropdown -->
                                <table id="product-table" class="table table-bordered display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Tên sản phẩm</th>
                                        <th>SKU</th>
                                        <th>Giá</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Tên sản phẩm</th>
                                        <th>SKU</th>
                                        <th>Giá</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><img src="{{getProductImage($product->images)}}" width="60" alt=""></td>
                                            <td><a href="javascript:void(0)"  data-value="{{$product->id}}">{{$product->name}}</a></td>
                                            <td>{{$product->sku}}</td>
                                            <td>{{$product->price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-content -->
                        </div>
                        <!-- /.col-xs-12 -->
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" id="child_product" name="child_product" value="{{old('child_product')}}">

                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal" id="update-order">Cập nhật</button>
                </div>

            </div>
        </div>
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

        $(".payment_method").click(function () {
            if ($(this).is(":checked")) {
                $(".payment_method").prop('checked', false);
                $(this).prop('checked', true);
            }
        });
    </script>

    <!--Select product-->
    <script>
        $(document).ready(function() {

            var arr = [];

            var table = $('#product-table').DataTable();

            $('#product-table tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                $(this).toggleClass('color-toggle');
                var nameCol = data[1];

                var id = parseInt($(nameCol).attr('data-value'));

                if($.inArray(id, arr) !== -1){
                    var i = arr.indexOf(id);

                    arr.splice(i,1);
                }else{
                    arr.push(id);
                }
                console.log(arr);

                $("#order_product").val(arr);
            } );

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#update-order').click(function (e) {

                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: window.location.origin+'/admin/order/update/cart',
                    dataType: 'json',
                    data: {arr:arr},
                    success: function(data) {
                        console.log(data);
                        window.location.reload();
                    },

                    error: function(xhr, textStatus, error){
                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(error);
                    }
                });
            });
        } );
    </script>

    <script>

    </script>
@endsection