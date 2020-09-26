@if(get_field('prefooter'))
  @while(have_rows('prefooter')) @php(the_row())
    @if(get_sub_field('status') == 'enable')
      <section class="prefooter"
        style="
        background: {{the_sub_field('background')}};
        color: {{the_sub_field('colour')}};
      ">
        <div class="container grid">
          <div class="left">
            <div class="h4 wrapper max-550 mb-m">
              {{the_sub_field('description')}}
            </div>
            @php($link = get_sub_field('link'))
            @include('partials.link', ['class' => 'button'])
          </div>
          <div class="right">
            @php($image = get_sub_field('image'))
            @include('partials.image')
          </div>
        </div>
      </section>
    @endif
  @endwhile
@endif