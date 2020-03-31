$('.btn-filter').click(function () {
    $('form.form').submit();
});
@php
    $limit = array_pull( $filters, 'limit' );

    if( !is_array( $limit ) ) echo "$('*[name=limit]').val('".$limit."');";

    array_pull( $filters, 'offset' );
    array_pull( $filters, 'sort' );
    array_pull( $filters, 'dir' );
    array_pull( $filters, 'reset' );
    $entrouFilter = false;

@endphp
<!-- AQUI -->
@foreach($filters as $key => $value)
    @if( !empty( $value ) || $value == 0 )
        @php $entrouFilter = true; @endphp
        @if( !is_array( $value ) )
            $('*[name={{$key}}]').val('{{$value}}');
        @else
            @foreach($value as $value2)
                $('select[name="{{$key}}[]"] option[value="{{$value2}}"]').prop("selected", true);
            @endforeach
        @endif
    @endif
@endforeach

@if( $entrouFilter )
    $('.btn-clear').removeClass('hidden');
@endif
@if( count( $filters ) > 0 )
$('#cardFilter').addClass('show');
$('#icon-filter').removeClass('ft-plus').addClass('ft-minus');
@endif
