<article @php post_class('service-full', $id) @endphp>
  <div class="container">
    <div class="grid">
      <div class="left post-image">
        <?= get_the_post_thumbnail($id, 'full'); ?>

        <div class="wrapper toggle">
          @if(get_field('group', $id))
            @while(have_rows('group', $id)) @php(the_row())
              <div class="group mt-m">
                @if(get_sub_field('heading'))
                  <h5><?= the_sub_field('heading'); ?></h5>
                @endif
                @if(get_sub_field('description'))
                  <div class="medium">
                    <?= the_sub_field('description'); ?>
                  </div>
                @endif
              </div>
            @endwhile
          @endif
          
          @if(get_field('action', $id))
            @while(have_rows('action', $id)) @php(the_row())
              <div class="description medium mt-m">
                @if(get_sub_field('description'))
                  <?= the_sub_field('description'); ?>
                @endif
                @php($link = get_sub_field('link', $id))
                @if($link)
                  <div class="mt-s">
                    @include('partials.link', ['class' => 'button small'])
                  </div>
                @endif
              </div>
            @endwhile
          @endif
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
              <div class="testimonial medium">
                @while(have_rows('testimonial', $id)) @php(the_row())
                  @if(get_sub_field('quote'))
                    <?= the_sub_field('quote'); ?>
                  @endif
                  @if(get_sub_field('source'))
                    &mdash; <?= the_sub_field('source'); ?>
                  @endif
                @endwhile
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</article>