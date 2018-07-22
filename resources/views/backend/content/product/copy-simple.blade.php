@extends('backend/layouts/master')

@section('title','Create Product')

@section('css')
    <!-- Select2 -->
    <!-- Remodal -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/modal/remodal/remodal.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/modal/remodal/remodal-default-theme.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugin/select2/css/select2.min.css')}}">

    <!-- Data Tables -->
    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datatables/media/css/dataTables.bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('backend/assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css')}}">

    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />


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
                <h4 class="box-title">Chỉnh sửa sản phẩm</h4>
                <div class="dropdown js__drop_down">
                    <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                    <ul class="sub-menu">
                        {{--<li><a href="#">Another action</a></li>--}}
                        {{--<li><a href="#">Something else there</a></li>--}}
                        {{--<li class="split"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                    </ul>
                    <!-- /.sub-menu -->
                </div>
                <!-- /.box-title -->
                <div class="card-content">
                    <form class="form-horizontal" action="{{route('product-simple.store')}}" id="product" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sku" class="col-sm-2 control-label">Mã sản phẩm</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Giá</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label">Số lượng</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="details" class="col-sm-2 control-label">Chi tiết</label>
                            <div class="col-sm-8">
                                <textarea name="details" id="details" cols="30" rows="10">
                                    {{ $product->details }}
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categories" class="col-sm-2 control-label">Danh mục</label>
                            <div class="col-sm-8">
                                <select class=" categories form-control" id="categories" name="categories[]" multiple="multiple">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ in_array($category->id, $cat_ids) ? "selected" : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="featured" class="col-sm-2 control-label">Nổi bật</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="featured" name="featured">
                                    <option value="0" {{$product->featured == 0 ? 'selected' : ''}} >No</option>
                                    <option value="1" {{$product->featured == 1 ? 'selected' : ''}} >Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="visibility" class="col-sm-2 control-label">Hiển thị</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="visibility" name="visibility">
                                    <option value="0" {{$product->visibility == 0 ? 'selected' : ''}} >No</option>
                                    <option value="1" {{$product->visibility == 1 ? 'selected' : ''}} >Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-sm-2 control-label">Bật</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="active" name="active">
                                    <option value="0" {{$product->active == 0 ? 'selected' : ''}} >No</option>
                                    <option value="1" {{$product->active == 1 ? 'selected' : ''}} >Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="in_stock" class="col-sm-2 control-label">Trong kho</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="in_stock" name="in_stock">
                                    <option value="0" {{$product->in_stock == 0 ? 'selected' : ''}} >No</option>
                                    <option value="1" {{$product->in_stock == 1 ? 'selected' : ''}} >Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images" class="col-sm-2 control-label">Ảnh nổi bật</label>
                            <div class=" col-xs-8">
                                <input type="file" name="image" id="file" />
                                <img class="imageThumb" id="imageThumb" src="{{getFeaturedImageProduct($product->image)}}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="images" class="col-sm-2 control-label">Ảnh phụ</label>
                            <div class=" col-xs-8">
                                <input type="file" name="images[]" multiple  id="files" />
                                @if($product->images)
                                    @foreach(json_decode($product->images) as $image)
                                        <img class="imageThumb" id="imageThumbs" src="{{getFeaturedImageProduct($image)}}">
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sort_order" class="col-sm-2 control-label">Thứ tự</label>
                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control" id="sort_order" name="sort_order" value="{{ $product->sort_order }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_title" class="col-sm-2 control-label">Meta Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $product->meta_title }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_desc" class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{ $product->meta_desc }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $product->meta_keyword }}">
                            </div>
                        </div>

                        @foreach($attributes as $attribute)
                            <div class="form-group">
                                <label for="attribute" class="col-sm-2 control-label">{{$attribute->name}}</label>
                                <div class="col-sm-8">
                                    {!! ManagerCatalog::getCustomAttribute($attribute, $product)!!}
                                </div>
                            </div>
                        @endforeach

                        <input type="hidden" class="form-control" id="type_id" name="type_id" value="simple">
                        {{ csrf_field() }}
                        <div class="form-group margin-bottom-0">
                            <div class="col-sm-offset-2 col-sm-8">
                                <input type="submit" name="save" class="btn btn-info btn-sm waves-effect waves-light" value="Lưu">
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


    <!-- Include external JS libs. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/js/froala_editor.pkgd.min.js"></script>


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

    <script src="{{asset('backend/web/js/preview.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            //Select 2
            $(".categories").select2({
                placeholder: "Select categories",
                allowClear: true
            });

            previewImage('#file', 'imageThumb');
            previewImages('#files', 'imageThumbs');
        });

    </script>

    <script>

        $(function() {
            $('#details').froalaEditor({
                heightMin: 300
            });
        });
    </script>

@endsection