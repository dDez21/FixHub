@props(['linkClass' => 'selected']) 

<!-- stampo ogni elemento visibile -->
@foreach ($navLinks as $link)
    <a class="{{ $linkClass }}" href="{{ url($link['path']) }}">
        {{ $link['label'] }}
    </a>
@endforeach