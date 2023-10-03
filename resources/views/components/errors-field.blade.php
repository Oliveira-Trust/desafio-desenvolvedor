<!-- /resources/views/components/errors-field.blade.php -->

@props(['field'])

<div>
    @if ($errors->has($field))
        @foreach ($errors->get($field) as $error)
            <span class="help-block">{{ $error }}</span>
        @endforeach
    @endif
</div>
