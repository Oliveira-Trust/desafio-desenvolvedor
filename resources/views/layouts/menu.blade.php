<div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                @include(config('laravel-menu.views.bootstrap-items'), ['items' => $NavBar->roots()])
        </div>
    </nav>
</div>
