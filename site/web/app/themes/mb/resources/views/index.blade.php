@extends('layouts.app')

@section('content')
  <section class="index container">
    @include('partials.page-header')

    <section class="blog grid three-col my-xl">
      @while(have_posts()) @php(the_post())
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
      @endwhile
    </section>

    {!! get_the_posts_navigation() !!}
  </section>
@endsection
