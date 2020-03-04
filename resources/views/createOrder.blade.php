@extends('layouts.app')

@section('content')
    <div class="container">
        {{$order}}
    </div>
@endsection

<script>
    jQuery(document).ready(function(){
        jQuery('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ url('/grocery/post') }}",
                method: 'post',
                data: {
                    name: jQuery('#name').val(),
                    type: jQuery('#type').val(),
                    price: jQuery('#price').val()
                },
                success: function(result){
                    console.log(result);
                }});
        });
    });

    $("#btnAddCart").click(function() {
        var $row = $(this).closest("tr");    // Find the row
        var $text = $row.find(".idProduto").text(); // Find the text

        // Let's test it out
        alert($text);
    });
</script>
