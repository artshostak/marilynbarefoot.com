<article @php post_class('client', $id) @endphp>
  <div class="post-image">
    <div class="post-featured-image circle border">
      <?= get_the_post_thumbnail($id, 'full'); ?>
    </div>
  </div>
  <div class="post-content hidden">
    <a href="{{ get_permalink($id) }}">
      <?= get_the_title($id); ?>
    </a>
    @php($types = get_the_terms($id, 'types'))
    <div class="categories" data-field="categories"><?php if($types){ foreach($types as $type){ echo $type->name . ', '; }} ?><?php if($years){ foreach($years as $year){ echo $year->name . ', '; }} ?><?php if($locations){ foreach($locations as $location){ echo $location->name . ', '; }} ?></div>
  </div>
</article>