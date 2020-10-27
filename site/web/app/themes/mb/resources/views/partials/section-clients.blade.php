@if(get_field('testimonial'))
  <section class="testimonial container">
    <div class="glide">
      <div data-glide-el="track" class="glide__track">
        <ul class="glide__slides">
          @while(have_rows('testimonial')) @php(the_row())
            <div class="glide__slide">
              {{the_sub_field('name')}}
              <div class="quote">
                <h4><?= the_sub_field('quote'); ?></h4>
              </div>
              <div class="source">
                <small>&mdash; <?= the_sub_field('source'); ?></small>
              </div>
            </div>
          @endwhile
        </ul>
        <div class="glide__arrows" data-glide-el="controls">
          <a class="glide__arrow glide__arrow--left" data-glide-dir="<">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
              <g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"><g stroke="#000"><g><path d="M24 6L24 24 6 24" transform="translate(-40 -735) rotate(90 -332.5 402.5) rotate(45 15 15)"/></g></g></g>
            </svg>
          </a>
          <a class="glide__arrow glide__arrow--right" data-glide-dir=">">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
              <g fill="none" fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"><g stroke="#000"><g><path d="M24 6L24 24 6 24" transform="translate(-90 -735) matrix(0 1 1 0 90 735) rotate(45 15 15)"/></g></g></g>
            </svg>
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
    'orderby' => 'name',
    'order'   => 'ASC',
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