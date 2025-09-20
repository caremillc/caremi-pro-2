@props([
    'title' => 'Notice',
    'type'  => 'info'
])

<div class="alert alert-{{ $type }}">
    <strong>{{ $title }}</strong>
    <div>{{ $slot }}</div>

    @if(isset($footer))
        <div class="mt-2 text-muted small">{{ $footer }}</div>
    @endif
</div>
