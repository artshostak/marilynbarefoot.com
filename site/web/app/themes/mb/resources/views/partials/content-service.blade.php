<article @php post_class('service', $id) @endphp>
  <a class="post-image" href="{{ get_permalink($id) }}">
    <div class="post-featured-image">
      <?= get_the_post_thumbnail($id, 'full'); ?>
    </div>
  </a>
  <div class="post-content">
    <a href="{{ get_permalink($id) }}">
      <h3><?= get_the_title($id); ?></h3>
    </a>
    @if(get_the_excerpt($id))
      <?= get_the_excerpt($id); ?>
    @endif
  </div>
</article>