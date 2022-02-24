@if($show)
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>
@endif
