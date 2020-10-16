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