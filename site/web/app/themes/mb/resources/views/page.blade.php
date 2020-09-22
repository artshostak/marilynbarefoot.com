@extends('layouts.app')

@section('content')
  <section class="single-page container">
    @while(have_posts()) @php(the_post())
      @include('partials.page-header')
      @includeFirst(['partials.content-page', 'partials.content'])
    @endwhile
  </section>
@endsection
