@extends('backend/layouts/master')

@section('title','Create Post')
<link rel="stylesheet" href="{{asset('backend/assets/plugin/select2/css/select2.min.css')}}">
<!-- Include external CSS. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

<!-- Include Editor style. -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />

<!-- Dropify -->
<link rel="stylesheet" href="{{asset('backend/assets/plugin/dropify/css/dropify.min.css')}}">
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
				<h4 class="box-title">Chỉnh sửa bài viết</h4>
				<!-- /.box-title -->

				<div class="card-content">
					<form class="form-horizontal" action="{{route('post.update', $post->id)}}" id="post" method="post" enctype="multipart/form-data">
						{{method_field('PUT')}}
						{{ csrf_field() }}
						<div class="form-group">
							<label for="title" class="col-sm-2 control-label">Tiêu đề</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
							</div>
						</div>
						<div class="form-group">
							<label for="slug" class="col-sm-2 control-label">Slug</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="slug" name="slug" value="{{ $post->slug}}">
							</div>
						</div>
						<div class="form-group">
							<label for="description" class="col-sm-2 control-label">Mô tả</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="description" name="description" value="{{ $post->description}}" />
							</div>
						</div>
						<div class="form-group">
							<label for="meta_title" class="col-sm-2 control-label">Meta Title</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $post->meta_title}}">
							</div>
						</div>
						<div class="form-group">
							<label for="meta_desc" class="col-sm-2 control-label">Meta Description</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="meta_desc" name="meta_desc" value="{{ $post->meta_desc}}">
							</div>
						</div>
						<div class="form-group">
							<label for="meta_keyword" class="col-sm-2 control-label">Meta Keyword</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ $post->meta_desc}}">
							</div>
						</div>

						<div class="form-group">
							<label for="topics" class="col-sm-2 control-label">Danh mục bài viết</label>
							<div class="col-sm-8">
								<select class="topics form-control" id="topics" name="topics[]" multiple="multiple">
									@foreach($topics as $topic)
										<option value="{{$topic->id}}"  {{ in_array($topic->id, $post_topics) ? "selected" : ''}}>{{$topic->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="categories" class="col-sm-2 control-label">Gán thẻ</label>
							<div class="col-sm-8">
								<select class=" tags form-control" id="tags" name="tags[]" multiple="multiple">
									@foreach($tags as $tag)
										<option value="{{$tag->id}}" {{( in_array($tag->id, $post_tags) ? 'selected':'')}}>{{$tag->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="active" class="col-sm-2 control-label">Bật</label>
							<div class="col-xs-1">
								<select class="form-control" id="active" name="active">
									<option value="0" {{ $post->active == 0 ? 'selected': ''}}>No</option>
									<option value="1" {{ $post->active == 1 ? 'selected': ''}}>Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="featured" class="col-sm-2 control-label">Nổi bật</label>
							<div class="col-xs-1">
								<select class="form-control" id="featured" name="featured">
									<option value="0" {{ $post->featured == 0 ? 'selected': ''}}>No</option>
									<option value="1" {{ $post->featured == 1 ? 'selected': ''}}>Yes</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="image" class="col-sm-2 control-label">Ảnh</label>
							<div class="col-sm-8">
								<!-- /.dropdown js__dropdown -->
								<input type="file" name="image" id="input-file-now-custom-1" class="dropify" data-default-file="{{getPostImage($post->image)}}" />
							</div>
						</div>
						<div class="form-group">
							<label for="featured" class="col-sm-2 control-label">Nội dung</label>
							<div class="col-sm-8">
								<textarea name="post_content" id="post_content">{{$post->post_content}}</textarea>
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
	<!--
	***************************************LIBRARY*************************************************
	_______________________________________________________________________________________________
	-->


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

	<!-- Dropify -->
	<script src="{{asset('backend/assets/plugin/dropify/js/dropify.min.js')}}"></script>
	<script src="{{asset('backend/assets/scripts/fileUpload.demo.min.js')}}"></script>

	<!--
	***************************************MYJSCODE*************************************************
	________________________________________________________________________________________________
	-->


	<script type="text/javascript">
        $(document).ready(function() {
            //Select 2
            $("#topics").select2({
                placeholder: "Select Topics",
                allowClear: true
            });

            //Select 2 for tag
            $("#tags").select2({
                placeholder: "Select Tags",
                allowClear: true
            });

//            previewImage('#file', 'imageThumb');
//            previewImages('#files', 'imageThumbs');
        });

	</script>

	<!-- Initialize the editor. -->
	<script>
        $(function() {
            $('#post_content').froalaEditor({
                heightMin: 300
            });
        });
	</script>

	<script>
        $(document).ready(function () {
            $("#title").keyup(function () {
                ChangeToSlug('title','slug');
            })
        })
	</script>
@endsection