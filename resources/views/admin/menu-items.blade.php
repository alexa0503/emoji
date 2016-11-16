@foreach($items as $item)
  <li@lm-attrs($item) @lm-endattrs>
    @if($item->link) <a@lm-attrs($item) @lm-endattrs @lm-attrs($item->link) @lm-endattrs href="{!! $item->url() !!}">
      {!! $item->title !!}
    </a>
    @else
      {!! $item->title !!}
    @endif
    @if($item->hasChildren())
      <ul class="sub">
        @include(config('laravel-menu.views.bootstrap-items'),
array('items' => $item->children()))
      </ul>
    @endif
  </li>
  @if($item->divider)
  	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
  @endif
@endforeach
