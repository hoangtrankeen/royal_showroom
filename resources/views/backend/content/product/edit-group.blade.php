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
                <h4 class="box-title">Chỉnh sửa nhóm sản phẩm</h4>
                <!-- /.box-title -->
                <div class="card-content">
                    <form class="form-horizontal" action="{{route('product-group.update', $product->id)}}" id="product" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sku" class="col-sm-2 control-label">Mã Sản phẩm</label>
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
                            <label for="details" class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="details" name="details" value="{{ $product->details }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Chi tiết</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" value="{{ $product->description }}">
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
                            <label for="images" class="col-sm-2 control-label">Ảnh</label>
                            <div class=" col-xs-8">
                                <input type="file" name="images[]" multiple  id="files" />
                                    @foreach(getAllProductImages($product->images) as $image)
                                        <img class="imageThumb" id="imageThumbs" src="{{$image}}">
                                    @endforeach
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

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <div class="box-content">
                                    <h4>Các sản phẩm con</h4>
                                    <table class="table table-striped table-bordered display">
                                        <thead>
                                        <tr>
                                            <th>stt</th>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($child_products as  $child)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>
                                                    <img src="{{getProductImage($child->image)}}" width="80" alt="">
                                                </td>
                                                <td>{{$child->name}}</td>
                                                <td>{{presentPrice($child->price)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="button" class="btn btn-success margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-2">Chọn sản phẩm con</button>
                            </div>
                        </div>
                        <!-- Button trigger modal -->
                        <input type="hidden" class="form-control" id="type_id" name="type_id" value="group">
                        <input type="hidden" class="form-control" id="child_product" name="child_product" value="{{($product->child_id)}}">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
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

@section('modal')
    <div class="modal fade" id="boostrapModal-2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel-1">Sản phẩm</h4>
                </div>
                <div class="modal-body">
                    <div class="row small-spacing">
                        <div class="col-xs-12">
                            <div class="box-content">
                                <!-- /.dropdown js__dropdown -->
                                <table id="product-table" class="table table-bordered display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Tên </th>
                                        <th>Mã sản phẩm</th>
                                        <th>Giá</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Tên </th>
                                        <th>Mã sản phẩm</th>
                                        <th>Giá</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @php
                                        $child_list = json_decode($product->child_id, true);

                                        $child_list = ($child_list)? $child_list : [];

                                    @endphp
                                    @foreach($all_products as $product)

                                        <tr class="{{in_array($product->id, $child_list) ? 'color-toggle': ''}}">
                                            <td><a href="{{route('product-group.edit', $product->id )}}"  data-value="{{$product->id}}">{{$product->name}}</a></td>
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
                    <button type="button" class="btn btn-default btn-sm waves-effect waves-light" data-dismiss="modal">Đóng</button>
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

    <!-- Full Screen Plugin -->
    <script src="{{asset('backend/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>

    <!-- Remodal -->
    <script src="{{asset('backend/assets/plugin/modal/remodal/remodal.min.js')}}"></script>

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

    <!--Select product-->
    <script>
        $(document).ready(function() {
            var arr =[];

            var ChildProduct = $('#child_product');

            if(ChildProduct.val().length > 0){
                arr = JSON.parse(ChildProduct.val());
                arr =   Object.keys(arr).map(function(key) {
                    return parseInt(arr[key],10);
                });
            }


            var table = $('#product-table').DataTable();

            $('#product-table tbody').on('click', 'tr', function () {
                var data = table.row( this ).data();
                $(this).toggleClass('color-toggle');
                var nameCol = data[0];

                var id = parseInt($(nameCol).attr('data-value'));

                if($.inArray(id, arr) !== -1){
                    i = arr.indexOf(id);

                    arr.splice(i,1);
                }else{
                    arr.push(id);
                }

                arr = JSON.stringify(arr);

                ChildProduct.val(arr);

                arr = JSON.parse(arr);

                console.log(arr);
            } );
        } );
    </script>

@endsection