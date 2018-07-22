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
                <h4 class="box-title">Create Group Product</h4>
                <!-- /.box-title -->
                <div class="card-content">
                    <form class="form-horizontal" action="{{route('product-group.store')}}" id="product" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Tên</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sku" class="col-sm-2 control-label">Mã sản phẩm</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug')}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price" class="col-sm-2 control-label">Giá</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" value="{{ old('price')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="quantity" class="col-sm-2 control-label">Số lượng</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="details" class="col-sm-2 control-label">Mô tả</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="details" name="details" value="{{ old('details')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Chi tiết</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="description" name="description" value="{{ old('description')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categories" class="col-sm-2 control-label">Danh mục</label>
                            <div class="col-sm-8">
                                <select class=" categories form-control" id="categories" name="categories[]" multiple="multiple">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{ old('categories') ? in_array($category->id,(old('categories'))) ? "selected" : '' : ''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="featured" class="col-sm-2 control-label">Nổi bật</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="featured" name="featured">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="visibility" class="col-sm-2 control-label">Hiển thị</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="visibility" name="visibility">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="active" class="col-sm-2 control-label">Bật</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="active" name="active">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="in_stock" class="col-sm-2 control-label">Trong kho</label>
                            <div class="col-xs-1">
                                <select class="form-control" id="in_stock" name="in_stock">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images" class="col-sm-2 control-label">Ảnh</label>
                            <div class=" col-xs-8">
                                <input type="file" name="image"  id="file" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="images" class="col-sm-2 control-label">Ảnh phụ</label>
                            <div class=" col-xs-8">
                                <input type="file" name="images[]" multiple  id="files" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sort_order" class="col-sm-2 control-label">Thứ tự</label>
                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order') ? old('sort_order') : 100}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_title" class="col-sm-2 control-label">Meta Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_desc" class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{ old('meta_desc')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ old('meta_keyword')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <button type="button" class="btn btn-success margin-bottom-10 waves-effect waves-light" data-toggle="modal" data-target="#boostrapModal-2">Chọn sản phẩm cho nhóm sản phẩm</button>
                            </div>
                        </div>
                        <!-- Button trigger modal -->

                        <input type="hidden" class="form-control" id="type_id" name="type_id" value="group">
                        <input type="hidden" class="form-control" id="child_product" name="child_product" value="{{old('child_product')}}">

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
                                <!-- /.box-title -->

                                <!-- /.dropdown js__dropdown -->
                                <table id="product-table" class="table table-bordered display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Giá</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Giá</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($products as $product)
                                        @php
                                            $child_list = explode(',', old('child_product'));

                                            $child_list = ($child_list)? $child_list : [];

                                        @endphp
                                        <tr class="{{in_array($product->id, $child_list) ? 'color-toggle': ''}}">
                                            <td><a href="{{route('product.edit', $product->id )}}"  data-value="{{$product->id}}">{{$product->name}}</a></td>
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
        });

    </script>

    <!--Select product-->
    <script>
        $(document).ready(function() {
            var arr =[];

            var ChildProduct = $('#child_product');

            if(ChildProduct.val().length > 0){
                arr = ChildProduct.val().split(",");

                arr = arr.map(function (x) {
                    return parseInt(x,10);
                });
            }

            console.log(arr);

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

                ChildProduct.val(arr);

                console.log(arr);
            } );

            previewImage('#file', 'imageThumb');
            previewImages('#files', 'imageThumbs');
        } );
    </script>

@endsection