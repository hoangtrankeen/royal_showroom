@php
    $html = $html.'|---';
@endphp

@foreach($children as $child)
    <option value="{{$child->id}}">
        {{$child->parents() ? $html:'' }}
        {{$child->name}}
    </option>

    @if(count($child->children))

        @include('backend/topic/in_create',['children' => $child->children, 'html' => $html])

    @endif
@endforeach