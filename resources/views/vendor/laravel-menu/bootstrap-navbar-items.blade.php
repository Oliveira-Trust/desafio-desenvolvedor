@foreach($items as $item)
<li @lm_attrs($item) @if($item->hasChildren()) class="nav-item dropdown" @else class="nav-item" @endif @lm_endattrs>
    @if($item->link)
    <a @lm_attrs($item->link) @if($item->hasChildren()) class="nav-link dropdown-toggle" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @else class="nav-link @if($item->isActive) active @endif" @endif @lm_endattrs href="{!! $item->url() !!}">
        {!! $item->title !!}
        @if($item->hasChildren()) <b class="caret"></b> @endif
    </a>
    @else
    <span class="navbar-text">{!! $item->title !!}</span>
    @endif
    @if($item->hasChildren())
    <ul class="dropdown-menu">
        @include(config('laravel-menu.views.bootstrap-items'), array('items' => $item->children()))
    </ul>
    @endif
</li>
@if($item->divider)
<li {!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
@endif
@endforeach
