
@php
    $html = $html.'|---';
@endphp

@foreach($childs as $child)
    <option {{(($child->id) ==($thiscat->parent_id)) ? 'selected':'' }}
            class="{{($child->id == $thiscat->id)?'hide-me':''}}"
            value="{{$child->id}}">
        {{$child->parent() ? $html:'' }}
        {{$child->name}}
    </option>

    @if(count($child->childs))

        @include('backend/category/in_edit',['childs' => $child->childs->where('id','!=',$thiscat->id), 'html' => $html])

    @endif
@endforeach