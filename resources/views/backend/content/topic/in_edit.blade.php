
@php
    $html = $html.'|---';
@endphp

@foreach($children as $child)
    <option {{(($child->id) ==($thiscat->parent_id)) ? 'selected':'' }}
            class="{{($child->id == $thiscat->id)?'hide-me':''}}"
            value="{{$child->id}}">
        {{$child->parents() ? $html:'' }}
        {{$child->name}}
    </option>

    @if(count($child->children))

        @include('backend/topic/in_edit',['children' => $child->children->where('id','!=',$thiscat->id), 'html' => $html])

    @endif
@endforeach