@extends('backend/layouts/master')

@section('title','All Product')

@section('css')
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
<div class="row small-spacing">
	<div class="col-xs-12">
		<div class="box-content">
			<h4 class="box-title">Danh sách sản phẩm</h4>

			<div class="btn-toolbar">
				<div class="btn-group  margin-bottom-30 pull-right">
					<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tạo sản phẩm <span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="{{route('product.create', ['type' => 'simple'])}}">Tạo sản phẩm lẻ</a></li>
						<li><a  href="{{route('product.create', ['type' => 'group'])}}">Tạo nhóm sản phẩm</a></li>
					</ul>
				</div>
			</div>

			<table id="example" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>Tên</th>
						<th>Loại</th>
						<th>Giá</th>
						<th>Nổi bật</th>
						<th>Ngày tạo</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Tên</th>
						<th>Loại</th>
						<th>Giá</th>
						<th>Nổi bật</th>
						<th>Ngày tạo</th>
						<th>Hành động</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($products as $product)
					<tr>
						<td><img src="{{getProductImage($product->images)}}" alt="" width="55"></td>
						<td><a href="{{route('product.edit', $product->id )}}">{{$product->name}}</a></td>
						<td>{{$product->type_id}}</td>
						<td>{{presentPrice($product->price)}}</td>
						<td>{{($product->featured) ? 'Nổi bật' :''}}</td>
						<td>{{presentDate($product->created_at)}}</td>
						<td>
							<a href="{{route('product.edit', $product->id)}}" class="btn btn-xs btn-info">Sửa</a>
							@if($product->type_id == 'simple')
								<form action="{{route('product-simple.destroy', $product->id)}}" method="post">
									{{method_field('DELETE')}}
									{{csrf_field()}}
									<button type="submit" class="delete btn btn-xs btn-danger">Xóa</button>
								</form>

								@elseif($product->type_id == 'group')

								<form action="{{route('product-group.destroy', $product->id)}}" method="post">
									{{method_field('DELETE')}}
									{{csrf_field()}}
									<button type="submit" class="delete btn btn-xs btn-danger">Xóa</button>
								</form>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- /.box-content -->
	</div>
	<!-- /.col-xs-12 -->
</div>

@endsection

@section('javascript')
	<!-- Data Tables -->
	<script src="{{asset('backend/assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/datatables.demo.min.js')}}"></script>


	<script>
        $("#stock").on("change", function () {
            var stock = $(this).val();
            window.location.href = window.location.origin + '/'+'admin/product/'+ '?stock='+stock;
        });
	</script>
@endsection