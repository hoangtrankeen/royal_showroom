@extends('backend/layouts/master')

@section('title','Edit Category')

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
                <h4 class="box-title">Chỉnh sửa danh mục sản phẩm</h4>
                <!-- /.box-title -->

                <div class="card-content">
                    <form class="form-horizontal" action="{{route('category.update', $thiscat->id)}}" id="category" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{$thiscat->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{$thiscat->slug}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Thứ tự</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="order" name="order" value="{{$thiscat->order}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="order" class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" value="{{$thiscat->description}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categories" class="col-sm-2 control-label">Danh mục cha</label>
                            <div class="col-sm-8">
                                <select class=" categories form-control" id="parent_id" name="parent_id">
                                    <option value="0">-----</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{($category->id) ==($thiscat->parent_id) ? 'selected':'' }}>{{$category->name}}</option>
                                        @if(count($category->childs))
                                            @include('backend/category/in_edit',['childs' => $category->childs, 'html'=>''])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-sm-2 control-label">Bật</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="active" name="active">
                                    <option value="0" {{ $thiscat->active == 0 ? 'selected': ''}}>No</option>
                                    <option value="1" {{ $thiscat->active == 1 ? 'selected': ''}}>Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Ảnh</label>
                            <div class="col-sm-8">
                                <!-- /.dropdown js__dropdown -->
                                <input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="{{getCategoryImgFeatured($thiscat->image)}}" />
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
@endsection