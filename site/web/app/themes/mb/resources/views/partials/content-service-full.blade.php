<article @php post_class('service-full', $id) @endphp>
  <div class="container">
    <div class="grid">
      <div class="left post-image">
        <?= get_the_post_thumbnail($id, 'full'); ?>
      </div>
      <div class="right post-content">
        <h3><?= get_the_title($id); ?></h3>
        @if(get_the_content('', '', $id))
          <?= get_the_content('', true, $id); ?>
        @endif
      </div>
    </div>
  </div>
</article>