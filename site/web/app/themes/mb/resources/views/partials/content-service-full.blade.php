<article id="{{basename(get_permalink($id))}}" @php post_class('service-full', $id) @endphp>
  <div class="container">
    <div class="grid">
      <div class="left post-image">
        <?= get_the_post_thumbnail($id, 'full'); ?>
        <div class="hide-small">
          <div class="wrapper toggle">
            @include('partials.service-details')
          </div>
        </div>
      </div>
      <div class="right post-content">
        <h3><?= get_the_title($id); ?></h3>
        <div class="wrapper">
          @if(get_the_content('', '', $id))
            @php($content = apply_filters('the_content', get_post_field('post_content', $id)))
            <?= $content; ?>
          @endif
          
          @if(get_field('testimonial', $id))
            <div class="toggle">
              @while(have_rows('testimonial', $id)) @php(the_row())
                @if(get_sub_field('quote') || get_sub_field('source'))
                  <div class="testimonial medium">
                    <?= the_sub_field('quote'); ?>
                    &mdash; <?= the_sub_field('source'); ?>
                  </div>
                @endif
              @endwhile
            </div>
          @endif
          
          <div class="show-small-only">
            <div class="toggle">
              @include('partials.service-details')
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>