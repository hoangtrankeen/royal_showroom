@extends('backend/layouts/master')

@section('title','Create Attribute')

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
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box-content card white">
                <h4 class="box-title">Tạo thuộc tính</h4>
                <!-- /.box-title -->

                <div class="card-content">
                    <form class="form-horizontal" action="{{route('attribute.store')}}" id="category" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tên thuộc tính</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-sm-2 control-label">Loại</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="type" name="type">
                                    @foreach($attr_types as $type)
                                        <option value="{{$type}}" {{ ($type == old('type')) ? "selected" : ''}}>{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inform_name" class="col-sm-2 control-label">Tên trong form</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="inform_name" name="inform_name" value="{{ old('inform_name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-sm-2 control-label">Bật</label>
                            <div class="col-sm-8">
                                <select name="active" id="active" class="form-control">
                                    <option value="1" {{old('active') ==1 ? 'selected':''}}>On</option>
                                    <option value="0" {{old('active') == 0 ? 'selected':''}}>Off</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group type-toggle">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="text" class="form-control attr_value" name="attr_value_1">
                            </div>
                        </div>
                        <div class="form-group type-toggle">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button class="btn btn-danger waves-effect waves-light btn-icon btn-icon-left " id="add-attr"><i class="ico fa fa-plus" aria-hidden="true"></i>Gán giá trị cho thuộc tính</button>
                            </div>
                        </div>

                        {{ csrf_field() }}
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

    <script>
        $(document).ready(function () {
            var i = 1;
            $('#add-attr').click(function (e) {
                e.preventDefault();
                i = i + 1;
                $("input[name='attr_value_1']").clone().attr('name','attr_value_'+i).val('').insertBefore('#add-attr');
            });

            function checkFirstType(){
                if($('#type').val() === 'select'){
                    $('.type-toggle').show();
                }
            }

            checkFirstType();

            $('#type').on('change',function () {

                if($(this).val() === 'text'){
                    $('.type-toggle').hide();
                }

                if($(this).val() === 'select'){
                    $('.type-toggle').show();
                }

            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#name").keyup(function () {
                ChangeToSlug('name','inform_name');
            })
        })
    </script>
@endsection