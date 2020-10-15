@if(get_field('testimonial'))
  <section class="testimonial container">
    <div class="glide">
      <div data-glide-el="track" class="glide__track">
        <ul class="glide__slides">
          @while(have_rows('testimonial')) @php(the_row())
            <div class="glide__slide">
              <small>{{the_sub_field('name')}}</small>
              <div class="wrapper max-734">
                <h4><?= the_sub_field('quote'); ?></h4>
              </div>
              <div class="wrapper max-348">
                <small>&mdash; <?= the_sub_field('source'); ?></small>
              </div>
            </div>
          @endwhile
        </ul>
        <div class="glide__arrows" data-glide-el="controls">
          <a class="glide__arrow glide__arrow--left" data-glide-dir="<">
            prev
          </a>
          <a class="glide__arrow glide__arrow--right" data-glide-dir=">">
            next
          </a>
        </div>
      </div>
    </div>
  </section>
@endif

<?php
  $args = array(
    'posts_per_page'=> '-1',
    'post_type' => 'client',
  );
  $loop = new WP_Query($args);
?>

<section id="filter-list" class="clients container mb-xl">
  <div class="filter-list medium py-m">
    <a href="#show-all" class="category show-all active">
      A-Z
    </a>
    <?php
      $categories = get_categories( array(
        'type' => 'client',
        'taxonomy' => 'types',
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty'   => true,
      ) );
      foreach( $categories as $category ) {
        echo '<a class="category outline">' . $category->name . '</a>';
      }
    ?>
  </div>

  @if($loop->have_posts())
    <ul class="grid six-col list unstyled">
      @while($loop->have_posts()) @php($loop->the_post())
        <li>
          @include('partials.content-client', ['id' => $loop->ID])
        </li>
      @endwhile
    </ul>
  @endif
  @php(wp_reset_query())
</section>