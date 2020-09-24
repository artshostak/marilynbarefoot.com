@if($image)
  <?= wp_get_attachment_image($image['id'], 'full'); ?>
@endif