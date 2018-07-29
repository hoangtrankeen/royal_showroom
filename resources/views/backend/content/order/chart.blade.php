
@extends('backend/layouts/master')

@section('title','Orders')

@section('css')
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
    <div class="row small-spacing">
        <div class="col-xs-12">
            <div class="box-content">

                <h3>Tổng giá trị các đơn hàng</h3>
                <div class="col-md-offset-9 col-md-3">
                    <select name="month" id="month" class="  form-control">
                        @foreach($months as  $k => $m)
                            <option value="{{$k}}" {{request()->get('month') == $k ? 'selected':''}}>{{$m}}</option>
                        @endforeach
                    </select>
                </div>

                  <div>{!! $chart->container() !!}</div>
            </div>
            <!-- /.box-content -->
        </div>
        <!-- /.col-xs-12 -->
    </div>

@endsection

@section('javascript')
    <script src=//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js charset=utf-8></script>
     {!! $chart->script() !!}

    <script>
        $("#month").on("change", function () {
            var month = $(this).val();
            window.location.href = window.location.origin + '/'+'admin/chart/order/amount/'+ '?month='+month;
        });
    </script>
@endsection