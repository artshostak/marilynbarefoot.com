{{-- Sticky Header --}}
<header class="sticky container">
  @if(get_field('speaker_reel'))
    <a class="underline" data-scroll-nav="1">
      @php($field = get_field_object('speaker_reel'))
      <small>{{$field['label']}}</small>
    </a>
  @endif
  @if(get_field('video_series'))
    <a class="underline" data-scroll-nav="2">
      @php($field = get_field_object('video_series'))
      <small>{{$field['label']}}</small>
    </a>
  @endif
  @if(get_field('press'))
    <a class="underline" data-scroll-nav="3">
      @php($field = get_field_object('press'))
      <small>{{$field['label']}}</small>
    </a>
  @endif
  @if(get_field('blog'))
    <a class="underline" data-scroll-nav="4">
      @php($field = get_field_object('blog'))
      <small>{{$field['label']}}</small>
    </a>
  @endif
</header>

{{-- Speaker Reel --}}
@if(get_field('speaker_reel'))
  <section class="speaker-reel container" data-scroll-index="1">
    <header class="mb-m">
      @php($field = get_field_object('speaker_reel'))
      <h3>{{$field['label']}}</h3>
    </header>
    @while(have_rows('speaker_reel')) @php(the_row())
      <div class="big-video">
        @include('partials.vimeo')
        <p>{{the_sub_field('caption')}}</p>
      </div>
    @endwhile
  </section>
@endif

{{-- Video Series --}}
@if(get_field('video_series'))
  <section class="video-series" data-scroll-index="2">
    <header class="container">
      @php($field = get_field_object('video_series'))
      <h3>{{$field['label']}}</h3>
    </header>
    @while(have_rows('video_series')) @php(the_row())
      <div class="series border-bottom pb-m">
        <header class="container py-m">
          <h4 class="wrapper max-734">{{the_sub_field('title')}}</h4>
        </header>
        @if(get_sub_field('series'))
          @while(have_rows('series')) @php(the_row())
            <div class="episode mb-m container">
              <div class="grid">
                <div class="left">
                  @include('partials.vimeo')
                </div>
                <div class="right">
                  @if($episode = get_sub_field( 'episode'))
                    Episode <?= esc_html( $episode ); ?>
                  @endif
                  @if($title = get_sub_field( 'title'))
                    <h4><?= esc_html( $title ); ?></h4>
                  @endif
                </div>
              </div>
            </div>
          @endwhile
        @endif
      </div>
    @endwhile
  </section>
@endif

{{-- Press --}}
@if(get_field('press'))
  <section class="press container" data-scroll-index="3">
    <header class="mb-l">
      @php($field = get_field_object('press'))
      <h3>{{$field['label']}}</h3>
    </header>
    <div class="grid three-col">
      @while(have_rows('press')) @php(the_row())
        <div class="item mb-l">
          <small>{{the_sub_field('item')}}</small>
          <div class="h4">
            @php($link = get_sub_field('link'))
            @include('partials.link')
          </div>
        </div>
      @endwhile
    </div>
  </section>
@endif

{{-- Blog --}}
@php($blog = get_field('blog'))
@if($blog)
  <section class="blog" data-scroll-index="4">
    <header class="container">
      <div class="border-top flex spaced centered">
        <div class="left">
          @php($field = get_field_object('blog'))
          <p>{{$field['label']}}</p>
        </div>
        <div class="right">
          <a href="/blog">See all &rsaquo;</a>
        </div>
      </div>
    </header>
    <div class="scrollable">
      <div class="scroll">
        @foreach($blog as $b)
          @include('partials.content', ['id' => $b->ID])
        @endforeach
      </div>
    </div>
  </section>
@endif