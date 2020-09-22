@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    <section class="hero">
      @php($animation = get_field('animation'))
      @if($animation)
        <div
          id="lottie"
          data-name="{{$animation['title']}}"
          data-animation-path="{{$animation['url']}}"
          data-anim-loop="false"
        /></div>
      @endif

      @includeFirst(['partials.content-page', 'partials.content'])
    </section>
  @endwhile
@endsection
