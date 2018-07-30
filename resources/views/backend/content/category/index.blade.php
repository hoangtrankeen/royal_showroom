@extends('backend/layouts/master')

@section('title','All Category')

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
			<h4 class="box-title">Danh mục</h4>
			<div class="btn-toolbar">
				<div class="btn-group  margin-bottom-30 pull-right">
					<a class="btn btn-info" href="{{route('category.create')}}">Tạo danh mục sản phẩm</a>
				</div>
			</div>
			<!-- /.dropdown js__dropdown -->
			<table id="example" class="table table-striped table-bordered display" style="width:100%">
				<thead>
					<tr>
						<th>Tên</th>
						<th>Danh mục cha</th>
						<th>Ngày tạo</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Tên</th>
						<th>Danh mục cha</th>
						<th>Ngày tạo</th>
						<th>Hành động</th>
					</tr>
				</tfoot>
				<tbody>
					@foreach($categories as $category)
					<tr>
						<td><a href="{{route('category.edit', $category->id )}}">{{$category->name}}</a></td>
						<td>{{$category->parent_id}}</td>
						<td>{{presentDate($category->created_at)}}</td>
						<td>
							<a href="{{route('category.edit', $category->id)}}" class="btn btn-xs btn-info">Sửa</a>
							<form action="{{route('category.destroy', $category->id)}}" method="post">
								{{method_field('DELETE')}}
								{{csrf_field()}}
								<button type="submit" class="delete btn btn-xs btn-danger">Xóa</button>
							</form>
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
@endsection