@if( !empty( array_get( $paginator, 'prev_page' ) ) || !empty( array_get( $paginator, 'next_page' ) ) )
    <div class="row paginate">
        <div class="col-12 p-2">

            <nav aria-label="Page navigation">
                {!! format_html_paginate( $paginator ) !!}
            </nav>
        </div>
    </div>
@endif
