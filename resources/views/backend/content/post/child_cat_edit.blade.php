
@php
$html = $html.'|---';
@endphp

@foreach($childs as $child)
<option value="{{$child->id}}"
	{{(($child->id) ==($post->category_id)) ? 'selected':'' }}>
	{{$child->parent() ? $html:'' }}
	{{$child->name}}
</option>

@if(count($child->childs))

@include('manage/posts/child_cat_edit',['childs' => $child->childs, 'html' => $html])

@endif
@endforeach