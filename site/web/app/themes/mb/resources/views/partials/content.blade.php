<article @php post_class('post', $id) @endphp>
  <a href="{{ get_permalink($id) }}">
    <div class="post-image">
      <div class="post-featured-image">
        <?= get_the_post_thumbnail($id, 'full'); ?>
      </div>
    </div>
    <div class="post-content">
      <small><?= get_the_date('M d Y', $id); ?></small>
      <h4><?= get_the_title($id); ?></h4>
    </div>
  </a>
</article>