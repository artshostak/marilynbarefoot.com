@extends('layouts.app')

@section('content')
  <section class="single-post container">
    @while(have_posts()) @php(the_post())
      @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
    @endwhile
  </section>
@endsection
