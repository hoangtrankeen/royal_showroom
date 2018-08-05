@extends('backend/layouts/master')

@section('title','Royal')

@section('css')
    <!-- Dropify -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/dropify/css/dropify.min.css')}}">
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
            <div class="box-content card white">
                <h4 class="box-title">Chỉnh sửa phương thức vận chuyển</h4>
                <!-- /.box-title -->

                <div class="card-content">
                    <form class="form-horizontal" action="{{route('shipping-method.update', $shipping_method->id)}}" id="order-status" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $shipping_method->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="code" class="col-sm-2 control-label">Code</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="code" name="code" value="{{ $shipping_method->code }}">
                            </div>
                        </div> <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Giá Ship</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" value="{{ $shipping_method->price }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" value="{{ $shipping_method->description }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="details" class="col-sm-2 control-label">Chi tiết</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="details" name="details" value="{{ $shipping_method->details }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-sm-2 control-label">Hoạt động</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="active" name="active">
                                    {!! RenderHtml::getYesNoOption($shipping_method->active) !!}
                                </select>
                            </div>
                        </div>
                        <div class="form-group margin-bottom-0">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="submit" class="btn btn-info btn-sm waves-effect waves-light">Lưu</button>
                            </div>
                        </div>
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
    <!-- Dropify -->
    <script src="{{asset('backend/assets/plugin/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('backend/assets/scripts/fileUpload.demo.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#name").keyup(function () {
                ChangeToSlug('name','code');
            })
        })
    </script>
@endsection