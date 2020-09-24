@if($link)
  <a
    class="{{$class}}" 
    href="{{$link['url']}}"
    target="{{$link['target']}}"
    <?php if($class): ?>class="{{$class}}"<?php endif; ?> 
  >
    {{$link['title']}}
  </a>
@endif