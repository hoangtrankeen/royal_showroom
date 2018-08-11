@extends('backend/layouts/master')

@section('title','All Posts')

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
				<h4 class="box-title">Bài viết</h4>
				<div class="btn-toolbar">
					<div class="btn-group  margin-bottom-30 pull-right">
						<a class="btn btn-info" href="{{route('post.create')}}">Tạo bài viết</a>
					</div>
				</div>
				<table id="example" class="table table-striped table-bordered display" style="width:100%">
					<thead>
					<tr>
						<th></th>
						<th>Tiêu đề</th>
						<th>Hoạt động</th>
						<th>Nổi bật</th>
						<th>Ngày tạo</th>
						<th>Hành động</th>
					</tr>
					</thead>
					<tfoot>
					<tr>
						<th></th>
						<th>Tiêu đề</th>
						<th>Hoạt động</th>
						<th>Nổi bật</th>
						<th>Ngày tạo</th>
						<th>Hành động</th>
					</tr>
					</tfoot>
					<tbody>
					@foreach($posts as $post)
						<tr>
							<td>{{$post->id}}</td>
							<td>{{$post->title}}</td>
							<td>{{$post->active ? 'On' : 'Off'}}</td>
							<td>{{$post->featured ? 'On' : 'Off'}}</td>
							<td>{{presentDate($post->created_at)}}</td>
							<td>
								<a href="{{route('post.edit', $post->id)}}" class="btn btn-xs btn-info">Sửa</a>
								<form action="{{route('post.destroy', $post->id)}}" method="post">
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