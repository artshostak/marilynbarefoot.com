<article @php post_class('client', $id) @endphp>
  <a class="post-image" href="{{ get_permalink($id) }}">
    <div class="post-featured-image circle border">
      <?= get_the_post_thumbnail($id, 'full'); ?>
    </div>
  </a>
  <div class="post-content hidden">
    <a href="{{ get_permalink($id) }}">
      <?= get_the_title($id); ?>
    </a>
  </div>
</article>